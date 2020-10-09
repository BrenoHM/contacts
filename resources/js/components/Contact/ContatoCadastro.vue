<template>
    <el-form v-loading.fullscreen.lock="fullscreenLoading" :model="contact" :rules="rules" ref="ruleForm"
             label-width="180px" class="demo-ruleForm">
        <el-form-item label="Name" prop="name">
            <el-input v-model="contact.name"></el-input>
        </el-form-item>
        <el-form-item label="Email" prop="email">
            <el-input v-model="contact.email"></el-input>
        </el-form-item>
        <el-form-item label="Phone" prop="phone">
            <el-input v-model="contact.phone"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('ruleForm')" plain>{{textoSubmit}}</el-button>
            <el-button @click="resetForm('ruleForm')" plain>Reset</el-button>
            <el-button type="info" @click="backToList('ContactList')" plain>Go Back</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
    import Contact from '../../models/Contact'
    import ContactService from '../../requests/Contact'
    import Jquery from 'jquery';

    export default {
        name: 'ContactCadastro',
        data() {
            return {
                fullscreenLoading: false,
                contact: new Contact(),
                textoSubmit: this.$route.query.id ? 'Update' : 'Create',
                rules: {
                    name: [
                        {required: true, message: 'Please input contact name', trigger: 'blur'},
                    ],
                    email: [
                        {required: true, message: 'Please input contact email', trigger: 'blur'},
                        { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] }
                    ],
                    phone: [
                        {required: true, message: 'Please input contact phone', trigger: 'blur'},
                    ],
                }
            };
        },
        mounted() {
            if (this.$route.query.id) {
                this.fullscreenLoading = true;
                ContactService.getbyid({id: this.$route.query.id}).then(response => {
                    this.contact = new Contact(response.data);
                    this.fullscreenLoading = false;
                }).catch(error => {
                    
                    if( error.response.status == 401 ) {
                        this.$router.push({path: '/'})
                    }
                    
                    this.fullscreenLoading = false;
                    this.$notify.error({
                        title: 'Contact',
                        message: error.response.data.message,
                    });
                })
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.fullscreenLoading = true;

                        if (this.contact.id) {
                            ContactService.update(this.contact).then(response => {
                                if (response.data) {
                                    this.$notify({
                                        title: 'Contact',
                                        message: 'Successfully updated',
                                        type: 'success'
                                    });
                                }
                                this.fullscreenLoading = false;
                            }).catch(error => {
                                this.fullscreenLoading = false;
                                this.$notify.error({
                                    title: 'Contact',
                                    message: error.response.data.message,
                                });
                            })
                        } else {
                            ContactService.create(this.contact).then(response => {
                                if (response.data.data.id) {
                                    this.$notify({
                                        title: 'Contact',
                                        message: 'Successfully inserted',
                                        type: 'success'
                                    });
                                    this.$refs[formName].resetFields();
                                    Jquery('.el-icon-delete').click();
                                }
                                this.fullscreenLoading = false;
                            }).catch(error => {
                                this.fullscreenLoading = false;
                                this.$notify.error({
                                    title: 'Contact',
                                    message: error.response.data.message,
                                });
                            })
                        }
                    } else {
                        this.fullscreenLoading = false;
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            backToList(rota) {
                this.$router.push({name: rota});
            }
        }
    }
</script>
