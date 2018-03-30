let WebsiteImages = function () {
    "use strict";

    this.is_initialized = false
    this.is_updated = true
    this.$modal = false
    this.$image_container = false
    this.$pagination_container = false
    this.$total_images_counter = false
    this.$choose_image_btn = false
    this.$remove_image_btn = false
    this.$progress_bar = false
    this.$loading_img = false
    this.pagination = {
        initialized: false,
        page: 1,
        total: 0,
        limit: 0,
        total_page: 0,
        keyword: '',
        day: 0,
        month: 0,
        year: 0,
    }

    this.onChoose = (image_uri) => {
        console.log(image_uri)
    }

    this.select_multiple = false
    this.eventListeners = [];

    this.image_list = [];
    this.selected_images = [];

    this.options = {
        allowedFileTypes: ['image/png', 'image/jpeg', 'image/gif'],
        maxSizeInMb: 10
    }

    let self = this;

    this.isInitialized = () => {
        return this.is_initialized;
    }

    this.init = () => {
        this.is_initialized = true

        $('body').append(this.getModalTemplate())

        this.$modal = $('#pah-website-images')

        this.$image_container = this.$modal.find('.images-container')
        this.$pagination_container = this.$modal.find('ul.pagination')
        this.$total_images_counter = this.$modal.find('.total-images-counter')
        this.$choose_image_btn = this.$modal.find('.choose-image-btn')
        this.$progress_bar = this.$modal.find('.progress-bar')
        this.$loading_img = this.$modal.find('.loading-img')
        this.$remove_image_btn = this.$modal.find('.remove-image-btn')

        this.bindModalEvents()
    }


    this.addEventListener = (type, eventHandler) => {
        let listener = {}
        listener.type = type
        listener.eventHandler = eventHandler;
        this.eventListeners.push(listener)
    }

    this.on = (type, eventHandler) => {
        this.addEventListener(type, eventHandler)
    }

    this.dispatchEvent = (event) => {
        for (let i = 0; i < this.eventListeners.length; i++)
            if (event.type === this.eventListeners[i].type)
                this.eventListeners[i].eventHandler(event)
    }

    this.bindModalEvents = () => {
        this.$modal.on('click', '.open-explorer-btn', function () {
            self.$modal.find('.image-file-input').click()
        })

        this.$modal.on('show.bs.modal', function () {
            self.clearAllSelection()
        })

        // On select image file
        this.$modal.on('change', '.image-file-input', function () {
            let $this = $(this)
            let file_list = $this[0].files;

            if (file_list.length > 0) {
                if (!self.isValidFileType(file_list)) {
                    alert('Invalid file type!')
                    $this.val(null)
                    return;
                }

                if (!self.isValidFileSize(file_list)) {
                    alert('Invalid file size')
                    $this.val(null)
                    return;
                }

                self.doUpload(file_list)
            }
        })

        // On open Library tab
        this.$modal.on('click', '#library-tab > a', function (e) {
            if (!self.isInitialized() || self.isUpdated()) {
                self.reloadImageList()
            }
        })

        // Select image
        this.$modal.on('click', '.image-wrapper', function (e) {
            let $this = $(this)
            let image_id = parseInt($this.data('id'))

            for (let i = 0; i < self.selected_images.length; i++) {
                if (parseInt(self.selected_images[i].id) === image_id) {
                    self.selected_images.splice(i, 1)
                    self.dispatchEvent({
                        type: 'selectionChange',
                        modal: self
                    })
                    self.unSelectImage($this)
                    return;
                }
            }

            for (let i = 0; i < self.image_list.length; i++) {
                if (parseInt(self.image_list[i].id) === image_id) {
                    self.clearAllSelection(false)
                    self.selected_images.push(self.image_list[i])
                    self.selectImage($this)
                    self.dispatchEvent({
                        type: 'selectionChange',
                        modal: self
                    })
                    return;
                }
            }
        })

        // On click pagination item
        this.$pagination_container.on('click', 'a', function (e) {
            let $this = $(this)
            let $li = $this.closest('li')
            if (!$li.hasClass('active')) {
                self.pagination.page = parseInt($this.data('page'))
                self.$pagination_container.find('li').removeClass('active')
                $li.addClass('active')
                self.reloadImageList()
            }
        })

        this.$modal.on('click', '.submit-search', function (e) {
            self.pagination.day = parseInt($('#search_day').find(':selected').val())
            self.pagination.month = parseInt($('#search_month').find(':selected').val())
            self.pagination.year = parseInt($('#search_year').find(':selected').val())
            self.pagination.keyword = $('#search_keyword').val()
            self.is_updated = true

            self.reloadImageList()
        })

        this.$modal.on('keyup', '#search_keyword', function (e) {
            if (e.keyCode === 13) {
                self.$modal.find('.submit-search').click()
            }
        })

        this.on('selectionChange', function (e) {
            if (self.selected_images.length === 0) {
                self.$choose_image_btn.attr('disabled', 'disabled')
                self.$remove_image_btn.attr('disabled', 'disabled')
            } else {
                self.$choose_image_btn.removeAttr('disabled', 'disabled')
                self.$remove_image_btn.removeAttr('disabled', 'disabled')
            }
        })

        // On select
        this.$choose_image_btn.on('click', function (e) {
            if (typeof self.onChoose === 'function') {
                self.$modal.modal('hide')
                self.onChoose(self.selected_images[0])
            }
        })

        this.$remove_image_btn.on('click', function (e) {
            if (self.selected_images[0] && confirm('Are you sure to delete this image?')) {
                let image_id = self.selected_images[0]['id'];
                $.ajax({
                    url: '/pah-admin/website-images/remove/' + image_id,
                    type: 'post',
                    data: {
                        _csrfToken: $('meta[name=_csrfToken]').attr('content')
                    },
                    success: function () {
                        self.reloadImageList()
                    },
                    error: function () {

                    }
                })
            }

        })

        self.setUpTimeFilter()
    }

    this.setUpTimeFilter = () => {
        this.setUpYear()
        this.setUpMonth()
        this.setUpDay()

        self.$modal.find('#search_year').on('change', this.setUpMonth)
        self.$modal.find('#search_month').on('change', this.setUpDay)
    }

    this.setUpYear = () => {
        let now = new Date()
        let year_html = '<option value="">- Year -</option>'
        let max_year = now.getFullYear() + 1
        for (let i = max_year; i > 2007; i--) {
            year_html += '<option value="' + i + '">' + i + '</option>'
        }

        self.$modal.find('#search_year').html(year_html)
    }

    this.setUpMonth = () => {
        let selected_year = parseInt($('#search_year').find(':selected').val())
        let month_html = '<option value="">- Month -</option>'

        if (selected_year) {
            for (let i = 1; i <= 12; i++) {
                month_html += '<option value="' + i + '">' + i + '</option>';
            }
        }

        self.$modal.find('#search_month').html(month_html).change()
    }

    this.setUpDay = () => {
        let selected_month = parseInt($('#search_month').find(':selected').val())
        let day_html = '<option value="">- Day -</option>';

        if (selected_month) {
            let selected_year = parseInt($('#search_year').find(':selected').val())
            let last_day_of_month = new Date(selected_year, selected_month, 0)
            let max_date = last_day_of_month.getDate()

            for (let i = 1; i <= max_date; i++) {
                day_html += '<option value="' + i + '">' + i + '</option>';
            }
        }

        self.$modal.find('#search_day').html(day_html)
    }

    this.clearAllSelection = (dispatch_event = true) => {
        self.$modal.find('.image-wrapper').removeClass('selected')
        self.selected_images = [];

        if (dispatch_event) {
            self.dispatchEvent({
                type: 'selectionChange',
                modal: self
            })
        }
    }

    this.selectImage = ($image_item) => {
        $image_item.addClass('selected')
    }

    this.unSelectImage = ($image_item) => {
        $image_item.removeClass('selected')
    }

    this.isUpdated = () => {
        return this.is_updated;
    }

    this.setUpdated = (updated) => {
        if (updated) {
            this.is_updated = true
        } else {
            this.is_updated = false
        }
    }

    this.reloadImageList = (reset_current_page = false) => {
        if (reset_current_page) {
            self.pagination.page = 1;
        }

        NProgress.start()

        $.ajax({
            url: '/pah-admin/website-images/list',
            type: 'POST',
            data: {
                _csrfToken: $('meta[name=_csrfToken]').attr('content'),
                page: self.pagination.page,
                limit: self.pagination.limit,
                keyword: self.pagination.keyword,
                day: self.pagination.day,
                month: self.pagination.month,
                year: self.pagination.year,
            },
            success: function (response) {
                NProgress.done()
                self.image_list = response.data;
                self.pagination.limit = response.limit;
                self.pagination.page = response.page
                self.pagination.total = response.total;
                self.drawImageList()
                self.updatePaginationList()
                self.setUpdated(false)
                self.$total_images_counter.html('(' + self.pagination.total + ')')
                self.clearAllSelection()
            },
            error: function (e) {
                NProgress.done()
            }
        })
    }

    this.updatePaginationList = () => {
        let total_page = Math.ceil(self.pagination.total / self.pagination.limit)
        if (total_page !== self.pagination.total_page) {
            self.pagination.total_page = total_page
            let inserted_html = '';
            if (total_page > 1) {
                for (let i = 0; i < total_page; i++) {
                    let page = i + 1;
                    if (page === self.pagination.page) {
                        inserted_html += '<li class="active"><a href="#" data-page="' + page + '">' + page + '</a></li>';
                    } else {
                        inserted_html += '<li><a href="#" data-page="' + page + '">' + page + '</a></li>';
                    }
                }
            }

            self.$pagination_container.html(inserted_html)
        }
    }

    this.drawImageList = () => {
        let inserted_html = '';
        for (let i = 0; i < self.image_list.length; i++) {
            inserted_html += '' +
                '<div class="image-wrapper" data-id="' + self.image_list[i].id + '">' +
                '   <div class="image-item" style="background-image: url(' + self.image_list[i].uri + ')"></div>' +
                '   <div class="content">' +
                '       <p class="file-name"><strong>' + self.image_list[i].name + self.getFileExtension(self.image_list[i].uri) + '</p></strong>' +
                '       <p><strong>Created:</strong> ' + self.getDatetime(self.image_list[i].created) + '</p>' +
                '       <p><strong>Size:</strong> ' + self.image_list[i].width + 'x' + self.image_list[i].height + ' px</p>' +
                '   </div>' +
                '</div>'
        }
        this.$image_container.html(inserted_html)
    }

    this.getFileExtension = (uri) => {
        return uri.substring(uri.length - 4)
    }

    this.getDatetime = (time_string) => {
        return (new Date(time_string)).toLocaleString()
    }

    this.doUpload = (file_list) => {
        let formData = new FormData()
        let current_file_index = 0;
        uploadFile(file_list[current_file_index])

        self.$progress_bar.css('width', '0%')
        self.$progress_bar.html('0%')
        self.$progress_bar.show()
        self.$loading_img.show()

        function uploadFile(file) {
            formData.append('image', file)
            formData.append('_csrfToken', $('meta[name=_csrfToken]').attr('content'))

            return $.ajax({
                url: '/pah-admin/website-images/do-upload',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    let percent = parseInt((current_file_index + 1) / file_list.length * 100)
                    self.$progress_bar.css('width', percent + '%')
                    self.$progress_bar.html(percent + '%')

                    if (current_file_index < file_list.length - 1) {
                        current_file_index++
                        uploadFile(file_list[current_file_index])
                    } else {
                        self.$loading_img.hide()
                        self.setUpdated(true)
                        self.openLibraryTab()
                        self.$progress_bar.hide()
                    }
                },
                error: function (e) {
                    alert('Error while uploading image!')
                }
            })
        }
    }

    /**
     *
     * @param file_list
     * @returns {boolean}
     */
    this.isValidFileType = (file_list) => {
        if (self.options.allowedFileTypes === undefined) {
            return true
        }

        if (file_list.length > 0) {
            for (let i = 0; i < file_list.length; i++) {
                let file = file_list[i]
                if (self.options.allowedFileTypes.indexOf(file.type) < 0) {
                    return false
                }
            }

        } else {
            return false
        }

        return true
    }

    this.isValidFileSize = (file_list) => {
        if (self.options.maxSizeInMb === undefined) {
            return true
        }

        if (file_list.length > 0) {
            for (let i = 0; i < file_list.length; i++) {
                let file = file_list[i]

                if ((file.size / 1024 / 1024) > self.options.maxSizeInMb) {
                    return false
                }
            }
        } else {
            return false
        }

        return true
    }

    this.openLibraryTab = () => {
        this.$modal.find('#library-tab > a').click()
    }

    this.open = () => {
        if (!self.isInitialized()) {
            this.init()
        }

        this.$modal.modal('show')
    }

    this.getModalTemplate = () => {
        return '' +
            '<div id="pah-website-images" class="modal fade images-modal" tabindex="-1" role="dialog">\n' +
            '   <div class="modal-dialog" role="document">\n' +
            '       <div class="modal-content" style="border-radius: 0;">\n' +
            '           <div class="modal-body">\n' +
            '               <button type="button" class="close close-modal-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
            '               <div class="clearfix"></div>\n' +
            '               <div>\n' +
            '                   <ul class="nav nav-tabs" role="tablist">\n' +
            '                       <li role="presentation" class="active">\n' +
            '                           <a href="#home" aria-controls="home" role="tab" data-toggle="tab">\n' +
            '                               <i class="fa fa-plus" aria-hidden="true"></i> Upload new image\n' +
            '                           </a>\n' +
            '                       </li>\n' +
            '                       <li id="library-tab" role="presentation">\n' +
            '                           <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">\n' +
            '                               <i class="fa fa-picture-o" aria-hidden="true"></i> Library\n' +
            '                               <span class="total-images-counter"></span> \n' +
            '                           </a>\n' +
            '                       </li>\n' +
            '                   </ul>\n' +
            '                   <div class="tab-content">\n' +
            '                       <div role="tabpanel" class="tab-pane text-center active" id="home" style="padding: 50px 0;">\n' +
            '                           <button type="button" class="btn btn-default btn-lg open-explorer-btn">Select image to upload</button>\n' +
            '                           <input type="file" class="hidden image-file-input" name="files[]" multiple>\n' +
            '                           <br/>\n' +
            '                           <small>Max size: 10MB. Format: JPG, GIF, PNG</small>\n' +
            '                           <div class="clearfix"></div>\n' +
            '                           <div class="text-center"><img style="display: none" class="loading-img" src="/images/loading/loading.gif" width="100" /></div>\n' +
            '                           <div class="progress" style="margin-top: 5px">\n' +
            '                               <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 60%; display: none"></div>\n' +
            '                           </div>\n' +
            '                       </div>\n' +
            '                       <div role="tabpanel" class="tab-pane" id="profile">\n' +
            '                           <div class="search-input-group">\n' +
            '                               <select id="search_year" type="text" class="form-control"></select>\n' +
            '                               <select id="search_month" type="text" class="form-control"></select>\n' +
            '                               <select id="search_day" type="text" class="form-control"></select>\n' +
            '                               <input maxlength="255" placeholder="Keyword" id="search_keyword" type="text" class="form-control">\n' +
            '                               <button type="button" class="form-control btn btn-primary submit-search">Search</button>\n' +
            '                           </div>\n' +
            '                           <ul class="pagination"></ul>\n' +
            '                           <div class="clearfix"></div>\n' +
            '                           <div class="images-container"></div>\n' +
            '                       </div>\n' +
            '                   </div>\n' +
            '                   <div class="clearfix"></div>\n' +
            '                   <div class="footer-buttons">' +
            '                       <button type="button" class="btn btn-danger remove-image-btn"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>\n' +
            '                       <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>\n' +
            '                       <button type="button" style="margin-right: 10px;" class="btn btn-primary pull-right choose-image-btn">Choose image</button>\n' +
            '                       <div class="clearfix"></div>' +
            '                   </div>\n' +
            '               </div>\n' +
            '           </div>\n' +
            '       </div>\n' +
            '   </div>\n' +
            '</div>'
    }
}
