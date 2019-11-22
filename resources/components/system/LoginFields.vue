<template>
  
  <div>
        <a-row type="flex" align="middle">
            <a-col :span="12">
                <a-row type="flex">
                <a-col :span="20" :offset="2">
                    <a-card title="Card title">
                        <a-form
                            :form="loginForm"
                            method="post"
                            action="#admin/login/post/url"
                            @submit="handleSubmit"
                        >
                            <a-form-item label="Email Address">
                            <a-input
                                :auto-focus="true"
                                name="email"
                                v-decorator="[
                                'email',
                                {
                                    rules: [
                                        {   required: true, 
                                            message: 'Email Address is required' 
                                        }
                                    ]
                                }
                                ]"
                            />
                            </a-form-item>
                            
                            <a-form-item 
                               
                                label="Password Label">
                                <a-input
                                    name="password"
                                    type="password"
                                    v-decorator="[
                                    'password',
                                    {rules: [{ required: true, message: 'Password is required' }]}
                                    ]"
                                />
                            </a-form-item>
                            
                            <a-form-item>
                                <a-button
                                    type="primary"
                                    :loading="loadingSubmitBtn"
                                    html-type="submit"
                                >
                                    Login Button
                                </a-button>

                                <a class="ml-1" href="#forgot-password-url">Forgot password?</a>
                            </a-form-item>
                        </a-form>
                    </a-card>
                </a-col>
                </a-row>
            </a-col>
        
            <a-col :span="12">
              <a-row type="flex" align="middle" class="h-100 text-center">
              <a-col :span="24">
                    <img 
                        class="height-100"
                        src="/avored-admin/images/avored_admin_login.svg" 
                        width="55%" alt="AvoRed Admin Login" />
                </a-col>
                </a-row>
            </a-col>
        </a-row>
    </div>
</template>

<script>

export default {
  props: { name:'loginpost', type: String },
  data () {
    return {
      loginForm: this.$form.createForm(this),
      loadingSubmitBtn: false
    };
  },
  methods: {
    handleSubmit (e) {
      this.loadingSubmitBtn = true;
      this.loginForm.validateFields((err, values) => {
        if (err) {
          this.loadingSubmitBtn = false;
          e.preventDefault();
        }
      });
    }
  },
};
</script>
