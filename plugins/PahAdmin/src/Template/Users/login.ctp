<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content" style="padding: 0">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create() ?>
            <h1>Login Form</h1>
            <div>
                <?= $this->Form->control('username', [
                    'class' => 'form-control',
                    'data-parsley-required' => 'true',
                    'data-parsley-trigger' => 'change',
                    'placeholder' => 'Username',
                    'required' => 'true',
                    'label' => false
                ]) ?>
            </div>
            <div>
                <?= $this->Form->control('password', [
                    'class' => 'form-control',
                    'data-parsley-required' => 'true',
                    'data-parsley-trigger' => 'change',
                    'placeholder' => 'Password',
                    'required' => 'true',
                    'label' => false
                ]) ?>
            </div>
            <div>
                <button class="btn btn-default">Login in</button>
            </div>
            <?= $this->Form->end() ?>

            <div class="clearfix"></div>

            <div class="separator">
                <p class="change_link">New to site?</p>

                <div class="clearfix"></div>

                <div>
                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
            </div>
        </section>
    </div>
</div>