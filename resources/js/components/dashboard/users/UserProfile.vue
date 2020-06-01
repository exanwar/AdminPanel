<template>
    <div class="user_profile__wrapper">
        <!-- User personal Modal -->
        <div class="modal fade" id="user-profile-info" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Full Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Full name"
                                            v-model="personalInfo.name"
                                            :class="{ 'is-invalid': personalInfo.errors.has('name') }"
                                        />
                                        <has-error class="text-danger" :form="personalInfo" field="name"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="form-control-label ml-2 mt-2">Social Connections</label>
                                <div class="col-12">
                                    <div class="card card-fluid card-placeholder p-0">
                                        <div class="row m-3">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Facebook</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fab fa-facebook"></i>
                              </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Facebook"
                                                            aria-label="Facebook"
                                                            v-model="personalInfo.facebook"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">WhatsApp</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fab fa-whatsapp"></i>
                              </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="WhatsApp"
                                                            aria-label="WhatsApp"
                                                            v-model="personalInfo.whats_app"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Skype</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fab fa-skype"></i>
                              </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Skype"
                                                            aria-label="Skype"
                                                            v-model="personalInfo.skype"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Instagram</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fab fa-instagram"></i>
                              </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Instagram"
                                                            aria-label="Instagram"
                                                            v-model="personalInfo.instagram"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">LinedIn</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fab fa-linkedin"></i>
                              </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="LinkedIn"
                                                            aria-label="LinkedIn"
                                                            v-model="personalInfo.linkedin"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Phone</label>
                                                    <VuePhoneNumberInput v-model="personalInfo.phone"></VuePhoneNumberInput>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon rounded-pill"
                                    @click.prevent="updateUserPersonalinfo"
                                >
                                    <span class="btn-inner--text">Update Account</span>
                                    <span class="btn-inner--icon">
                    <i class="fas fa-long-arrow-alt-right"></i>
                  </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-sm btn-info rounded-pill"
                            data-dismiss="modal"
                        >Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Email Update Modal -->
        <div class="modal fade" id="user-email-update" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Email Adress Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" placeholder="Email address" v-model="emailUpdate.email" :class="{ 'is-invalid' : emailUpdate.errors.has('email')}">
                                        <has-error class="text-danger" :form="emailUpdate" field="email"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input :type="passwordFieldType" class="form-control" placeholder="********" v-model="emailUpdate.password">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="#"  @click.prevent="switchPasswordVisibility">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox my-3">
                                <input type="checkbox" class="custom-control-input" id="check-terms" v-model="emailUpdate.confirmemailUpdate">
                                <label class="custom-control-label" for="check-terms">Yes <a href="#">I want to change my email address.</a></label>
                            </div>
                            <div class="mt-4"><button type="button" class="btn btn-sm btn-danger btn-icon rounded-pill" @click.prevent="updateUserEmailInfo">
                                <span class="btn-inner--text">Update Email Address</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info rounded-pill" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Modal -->
        <div class="modal fade" id="user-password-update" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Password Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Current Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input :type="passwordFieldType" class="form-control" placeholder="********" v-model="passwordUpdate.previous">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                  <a href="#"  @click.prevent="switchPasswordVisibility">
                                                        <i class="fas fa-eye"></i>
                                                  </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input :type="passwordFieldType" class="form-control" placeholder="********" v-model="passwordUpdate.newPassword">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                  <a href="#"  @click.prevent="switchPasswordVisibility">
                                                        <i class="fas fa-eye"></i>
                                                  </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Re-enter New Password</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input :type="passwordFieldType" class="form-control" placeholder="********" v-model="passwordUpdate.newPasswordConfirm">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                  <a href="#"  @click.prevent="switchPasswordVisibility">
                                                        <i class="fas fa-eye"></i>
                                                  </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4"><button type="button" class="btn btn-sm btn-danger btn-icon rounded-pill" @click.prevent="updatePassword">
                                <span class="btn-inner--text">Update Password</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info rounded-pill" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Modal -->
        <div class="modal fade" id="user-image-update" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Image Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 offset-sm-3">
                                        <div class="text-center">
                                            <div class="avatar-parent-child">
                                                <img
                                                    alt="Image placeholder"
                                                    v-if="imageUpdate.newImage"
                                                    :src="imageUpdate.newImage"
                                                    class="avatar rounded-circle avatar-xl"
                                                    style="min-height: 200px; min-width:200px"
                                                />
                                                <img
                                                    alt="Image placeholder"
                                                    v-else
                                                    :src="imageUpdate.image"
                                                    class="avatar rounded-circle avatar-xl"
                                                    style="min-height: 200px; min-width:200px"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 my-5">
                                    <div class="input-group position-relative">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text font-weight-bold text-info">Image</label>
                                        </div>
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                name="postImage"
                                                @change="uploadUserPhoto"
                                            />
                                            <label class="custom-file-label">Select new profile image</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4"><button type="button" class="btn btn-sm btn-danger btn-icon rounded-pill" @click.prevent="updateUserImage">
                                <span class="btn-inner--text">Update profile image</span>
                                <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                            </button></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-info rounded-pill" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div  v-for="(user, index) in userData" :key="index">
            <!-- Page title -->
            <div class="page-title">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                        <!-- Page title + Go Back button -->
                        <div class="d-inline-block">
                            <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white" v-if="user.id === authUserData.id">My profile</h5>
                            <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white" v-else>{{ user.name }}'s profile </h5>
                        </div>
                        <!-- Additional info -->
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                        <div class="actions actions-dark d-inline-block">
                            <a href="#" class="action-item ml-md-4">
                                <i class="fas fa-file-export mr-2"></i>Export
                            </a>
                            <a href="#" class="action-item ml-3">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">

                    <!-- Profile stats -->
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <div class="avatar-parent-child">
                                        <img alt="Image placeholder" :src="user.image" class="avatar  rounded-circle avatar-lg" v-if="user.image">
                                        <img alt="Image placeholder" :src="'/images/users/default.jpg'" class="avatar  rounded-circle avatar-lg" v-else>
                                    </div>
                                </div>
                                <div class="col ml-md-n2">
                                    <h6 class="d-block h6 mb-0">{{ user.name }}</h6>
                                    <small class="d-block text-muted">{{ user.email }}</small>
                                    <small class="d-block text-muted">{{ user.phone }}</small>
                                    <small class="d-block text-primary font-weight-bold" v-if="user.role != 'customer'">
                                        <span v-if="user.devType === 'fullStack'">Full Stack Developer</span>
                                        <span v-if="user.devType === 'BEnd'">Back End Developer</span>
                                        <span v-if="user.devType === 'FEnd'">Front End Developer</span>
                                        <span v-if="user.role === 'admin'" class="badge badge-pill badge-info">Admin</span>
                                    </small>
                                    <small class="d-block text-danger" v-if="user.role === 'customer'">Member</small>

                                </div>
                                <div class="col-auto" v-if="user.id === authUserData.id">

                                    <div class="dropdown" data-toggle="dropdown">
                                        <button type="button" class="btn btn-xs btn-primary btn-icon rounded-pill" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                            <span class="btn-inner--text">Edit</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-bottom">
                                            <button class="dropdown-item" @click.prevent="editUserPersonalInfo(user)">Edit Profile Info</button>
                                            <button class="dropdown-item" @click.prevent="updateEmailButton(user)">Change Email Address</button>
                                            <button class="dropdown-item" @click.prevent="updateImageButton(user)">Change Profile Image</button>
                                            <button class="dropdown-item" @click.prevent="updatePasswordButton(user)">Change Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <span class="h5 mb-0">86</span>
                                    <span class="d-block text-sm">Images</span>
                                </div>
                                <div class="col-4 text-center">
                                    <span class="h5 mb-0">8</span>
                                    <span class="d-block text-sm">Products</span>
                                </div>
                                <div class="col-4 text-center">
                                    <span class="h5 mb-0">1578</span>
                                    <span class="d-block text-sm">Followers</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm px-0 font-weight-bold btn-link text-primary btn-icon">
                                        Message
                                    </button>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-xs btn-secondary rounded-pill">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Profile contacts -->
                    <div class="card card-fluid">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-sm mb-0">
                                        <i class="fab fa-facebook mr-2"></i>Facebook
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">{{ user.facebook }}</span>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-sm mb-0">
                                        <i class="fab fa-whatsapp mr-2"></i>Whats App
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">{{ user.whats_app }}</span>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-sm mb-0">
                                        <i class="fab fa-instagram mr-2"></i>Instagram
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">{{ user.instagram }}</span>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-sm mb-0">
                                        <i class="fab fa-skype mr-2"></i>skype
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">{{ user.skype }}</span>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-sm mb-0">
                                        <i class="fab fa-linkedin mr-2"></i>LinkedIn
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">{{ user.linkedin }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card card-fluid">
                        <div class="card-header border-0">
                            <h6 class="mb-0">My Posts</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name" style="width:100px">Post Title</th>
                                    <th scope="col" class="sort" data-sort="budget">Category</th>
                                    <th scope="col" class="sort" data-sort="status">Status</th>
                                    <th scope="col">Posted On</th>
                                </tr>
                                </thead>
                                <tbody class="list">
                                <tr v-for="(userPost, index) in user.posts" :key="index">
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <div>
                                                <img alt="Image placeholder" v-if="userPost.image === null || userPost.image === ''" :src="'/images/posts/default.png'" class="avatar  rounded-circle avatar-sm">
                                                <img alt="Image placeholder" v-else :src="'/images/posts/'+ userPost.image" class="avatar  rounded-circle avatar-sm">
                                            </div>
                                            <div class="media-body ml-4">
                                                <a href="overview.html" class="name mb-0 h6 text-sm">{{ userPost.title | limitTitle}}</a>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="budget" v-for="(category, index) in categories.data" :key="index" v-if="category.id === userPost.category">
                                        {{ category.name }}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <span v-if="userPost.status === 'private'">
                                                <i class="bg-warning"></i>
                                            </span>
                                            <span v-else >
                                                <i class="bg-success"></i>
                                            </span>

                                          <span class="status">{{ userPost.status }}</span>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="completion mr-2">{{ userPost.created_at | myDate }}</span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import VuePhoneNumberInput from "vue-phone-number-input";
    export default{
        components: {
            VuePhoneNumberInput
        },
        props:[
            'username'
        ],
        data(){
            return{
                userData:{},
                categories: {},
                authUserData:{},

                passwordFieldType: 'password',

                personalInfo : new Form({
                    'id' : '',
                    'name' : '',
                    'facebook' : '',
                    'whats_app' : '',
                    'skype' : '',
                    'instagram' : '',
                    'linkedin' : '',
                    'phone' : ''
                }),

                emailUpdate: new Form({
                    'id' : '',
                    'email' : '',
                    'password' : '',
                    'confirmemailUpdate' : false,
                }),

                passwordUpdate: new Form({
                    'id' : '',
                   'previous' : '',
                   'newPassword' : '',
                   'newPasswordConfirm': ''
                }),

                imageUpdate : new Form({
                    'id' : '',
                    'image': '',
                    'newImage' : ''
                })

            }
        },
        methods:{
            getUser(){
                axios.get('/api/users/' + this.username)
                    .then( ({data}) => {
                        this.userData = data
                    })
            },

            getActiveUser(){
                axios.get('/api/user')
                    .then( ({data}) => {
                        this.authUserData = data
                    })
            },
            getAllCategory(){
                axios.get('/api/category')
                    .then(({data}) => {
                        this.categories = data
                    });
            },

            switchPasswordVisibility(){
                this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
            },

            editUserPersonalInfo(user){
                this.personalInfo.reset();
                $('#user-profile-info').modal('show');
                this.personalInfo.fill(user);
            },

            updateUserPersonalinfo(){
                this.personalInfo.put('/api/updatepersonalinfo/' + this.personalInfo.id)
                    .then(() => {

                        Fire.$emit("loadUserPage");
                        $("#user-profile-info").modal("hide");
                        Swal.fire("Updated!",
                            "Update has been successful!.",
                            "success");
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            footer: ""
                        });
                    });
            },

            updateEmailButton(user){
                this.emailUpdate.reset();
                $('#user-email-update').modal('show');
                this.emailUpdate.fill(user);
            },

            updateUserEmailInfo(){
                if(this.emailUpdate.confirmemailUpdate){
                    this.emailUpdate.put('/api/updateemail/' + this.emailUpdate.id)
                        .then(() => {

                            Fire.$emit("loadUserPage");
                            $("#user-email-update").modal("hide");
                            Swal.fire("Updated!",
                                "Update has been successful!.",
                                "success");
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: ""
                            });
                        });
                }else {
                    console.log("Check the check box");
                }
            },

            updateImageButton(user){
                this.imageUpdate.reset();
                this.imageUpdate.fill(user);
                $('#user-image-update').modal('show');
            },
            uploadUserPhoto(e){
                const file = e.target.files[0];
                const reader = new FileReader();
                if (file["size"] < 2111775) {
                    reader.onloadend = file => {
                        this.imageUpdate.newImage = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops..",
                        text: "You are uploading a large image",
                        footer: ""
                    });
                }
            },

            updateUserImage(){
                if(this.imageUpdate.newImage){
                    this.imageUpdate.put('/api/updateimage/' + this.imageUpdate.id)
                        .then(() => {
                            Fire.$emit("loadUserPage");
                            $("#user-image-update").modal("hide");
                            Swal.fire("Updated!",
                                "Update has been successful!.",
                                "success");
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: ""
                            });
                        });
                }
            },
            updatePasswordButton(user){
                this.passwordUpdate.reset();
                this.passwordUpdate.fill(user)
                $('#user-password-update').modal('show');
            },
            updatePassword(){
                if(this.passwordUpdate.newPassword === this.passwordUpdate.newPasswordConfirm){
                    this.passwordUpdate.put('/api/updatepassword/' + this.passwordUpdate.id)
                        .then(() => {
                            Fire.$emit("loadUserPage");
                            $("#user-email-update").modal("hide");
                            Swal.fire("Updated!",
                                "Update has been successful!.",
                                "success");
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: ""
                            });
                        });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password didn't match",
                        footer: ""
                    });
                }
            }
        },

        created() {
            this.getUser();
            this.getActiveUser();
            this.getAllCategory();

            Fire.$on('loadUserPage', () => {
                this.getUser();
                this.getActiveUser();
                this.getAllCategory();
            });
        }
    }
</script>
