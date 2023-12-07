<div style="color:white;">
    <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?= $this->Flash->render(); ?>
                <?= $this->Form->create(); ?>
                    <h1 style="color:white;">Login Form</h1>
                    <div>
                        <?= $this->Form->control('email', [
                            'class' => 'form-control',
                            'placeholder' => 'Email',
                            'required' => true,
                            'type' => 'email',
                            'label' => [
                                'style' => 'color:white;font-weight:normal;'
                            ]
                        ]); ?>
                    </div>
                    <div>
                        <?= $this->Form->control('password', [
                            'class' => 'form-control',
                            'placeholder' => 'Password',
                            'required' => true,
                            'type' => 'password',
                            'label' => [
                                'style' => 'color:white;font-weight:normal;'
                            ]
                        ]); ?>
                    </div>
                    <div>
                        <?= $this->Form->button('Login', ['class' => 'btn btn-info submit']); ?>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link" style="font-weight:normal;font-size: 12px;">New to site? Request Credentials to Administrators</p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1 style="color:white;"><i class="fa fa-sitemap"></i> CS Communal</h1>
                            <p style="font-size:10px;">©2023 All Rights Reserved. YEHA | Mobile Suit | Version 1.0</p>
                        </div>
                    </div>

                <?= $this->Form->end(); ?>
            </section>
        </div>
    </div>
</div>