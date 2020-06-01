<template>
    <div class="project_card_list__wrapper">
        <!-- Create project modal -->
        <div class="modal fade" id="project-model" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!editProject">Add new project</h5>
                        <h5 class="modal-title" v-if="editProject">Edit project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Project Title</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Project Title....."
                                            v-model="form.name"
                                            :class="{ 'is-invalid': form.errors.has('name') }"
                                        />
                                        <has-error class="text-danger" :form="form" field="name"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mt-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label
                                                class="input-group-text font-weight-bold text-info"
                                                for="categoryName"
                                            >Category</label>
                                        </div>
                                        <select
                                            class="custom-select bg-light"
                                            name="categoryName"
                                            id="categoryName"
                                            v-model="form.category_id"
                                            :class="{'is-invalid': form.errors.has('category_id')}"
                                        >
                                            <option value>Chose a Category</option>
                                            <option
                                                v-for="(category, index) in categories.data"
                                                :key="index"
                                                :value="category.id"
                                                v-if="category.status === 'active'"
                                            >{{ category.name }}</option>
                                        </select>
                                        <has-error :form="form" field="category"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 mt-2" v-if="!editProject">
                                    <div class="input-group position-relative">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text font-weight-bold text-info">Logo</label>
                                        </div>
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                name="postImage"
                                                @change="uploadProjectLogo"
                                            />
                                            <label class="custom-file-label">Select logo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <label class="form-control-label">Customer</label>
                                    <select
                                        class="selectpicker form-control"
                                        data-live-search="true"
                                        v-model="form.customer_id"
                                        :class="{ 'is-invalid': form.errors.has('customer_id')}"
                                    >
                                        <option v-for="(user, index) in users" :key="index" v-show="user.role === 'customer'" :value="user.id">{{ user.name }} ({{ user.username }})</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 mt-3">
                                    <label class="form-control-label">Referance</label>
                                    <select
                                        class="selectpicker form-control"
                                        data-live-search="true"
                                        v-model="form.reference_id"
                                        :class="{ 'is-invalid': form.errors.has('reference_id')}"
                                    >
                                        <option v-for="(user, index) in users" :key="index" :value="user.id">{{ user.name }} ({{ user.username }})</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span
                                                class="input-group-text font-weight-bold text-info"
                                                id="basic-addon1"
                                            >Invoice No#</span>
                                        </div>
                                        <input
                                            type="number"
                                            class="form-control"
                                            placeholder="invoice"
                                            aria-label="invoice"
                                            v-model="form.invoice"
                                            :class="{ 'is-invalid': form.errors.has('invoice')}"
                                        />
                                        <has-error :form="form" field="duration"></has-error>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold text-info">Price</span>
                                        </div>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Price"
                                            aria-label="price"
                                            name="price"
                                            value
                                            v-model="form.ammount"
                                            :class="{ 'is-invalid': form.errors.has('ammount')}"
                                        />
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                        <has-error :form="form" field="price"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-control-label">Start Date</label>
                                    <input type="date" class="form-control" v-model="form.starting_date">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-control-label">Deadline</label>
                                    <input type="date" class="form-control" v-model="form.deadline">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                    <label class="form-control-label">
                                        Project Status
                                    </label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-status" id="radio-project-4" value="active" v-model="form.status" :class="{'is-invalid': form.errors.has('status')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-4">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-status" id="radio-project-5" value="finished" v-model="form.status" :class="{'is-invalid': form.errors.has('status')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-5">Finished</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-status" id="radio-project-6" value="due" v-model="form.status" :class="{'is-invalid': form.errors.has('status')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-6">Due</label>
                                            </div>
                                        </div>
                                        <has-error :form="form" field="status"></has-error>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                    <label class="form-control-label">
                                        Project privacy
                                    </label>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-privacy" id="radio-project-1" value="private" v-model="form.privacy" :class="{'is-invalid': form.errors.has('privacy')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-1">Private</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-privacy" id="radio-project-2" value="team" v-model="form.privacy" :class="{'is-invalid': form.errors.has('privacy')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-2">Team</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" class="custom-control-input" name="project-privacy" id="radio-project-3" value="public" v-model="form.privacy" :class="{'is-invalid': form.errors.has('privacy')}">
                                                <label class="custom-control-label form-control-label text-muted" for="radio-project-3">Public</label>
                                            </div>
                                        </div>
                                        <has-error :form="form" field="privacy"></has-error>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-control-label mb-0">Project description</label>
                                        <small
                                            class="form-text text-muted mb-2 mt-0"
                                        >This textarea will autosize while you type</small>
                                        <ckeditor
                                            :editor="editor"
                                            rows="1"
                                            v-model="form.description"
                                            :config="editorConfig"
                                            data-toggle="autosize"
                                            :class="{ 'is-invalid': form.errors.has('description') }"
                                        ></ckeditor>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="!editProject"
                            type="button"
                            class="btn btn-sm btn-primary rounded-pill mr-auto"
                            @click.prevent="publishProject"
                        >Publish</button>
                        <button
                            v-if="editProject"
                            type="button"
                            class="btn btn-sm btn-danger rounded-pill mr-auto"
                            @click.prevent="updateProject"
                        >Update</button>
                        <button
                            type="button"
                            class="btn btn-sm btn-danger rounded-pill"
                            v-show="editProject"
                            data-dismiss="modal"
                            @click.prevent="deleteProjectButton(form.project_id)"
                        >Delete</button>
                        <button
                            type="button"
                            class="btn btn-sm btn-info rounded-pill"
                            data-dismiss="modal"
                        >Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Logo -->
        <div class="modal fade" id="project-logo-change" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Logo Update</h5>
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
                                                    v-if="logoUpdate.newLogo"
                                                    :src="logoUpdate.newLogo"
                                                    class="avatar rounded-circle avatar-xl"
                                                    style="min-height: 200px; min-width:200px"
                                                />
                                                <img
                                                    alt="Image placeholder"
                                                    v-else
                                                    :src="logoUpdate.logo"
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
                                            <label class="input-group-text font-weight-bold text-info">Logo</label>
                                        </div>
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                class="custom-file-input"
                                                name="postImage"
                                                @change="uploadProjectLogo"
                                            />
                                            <label class="custom-file-label">Select new logo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4"><button type="button" class="btn btn-sm btn-danger btn-icon rounded-pill" @click.prevent="updateProjectLogo">
                                <span class="btn-inner--text">Update project logo</span>
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
        <!-- Category Modal -->
        <div class="modal fade" id="category-modal" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row m-3">
                            <div class="col-md-5">
                                <div class="card">
                                    <div
                                        class="card-header bg-primary font-weight-bold text-light"
                                        v-show="!editCat"
                                    >Add new category</div>
                                    <div
                                        class="card-header bg-danger font-weight-bold text-light"
                                        v-show="editCat"
                                    >Edit category</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                placeholder="Name of category"
                                                v-model="categoryForm.name"
                                                :class="{ 'is-invalid': categoryForm.errors.has('name') }"
                                            />
                                            <has-error class="text-danger" :form="categoryForm" field="name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select
                                                class="custom-select bg-light"
                                                v-model="categoryForm.status"
                                                :class="{ 'is-invalid': categoryForm.errors.has('status')}"
                                            >
                                                <option value>Select a type</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <has-error class="text-danger" :form="categoryForm" field="status"></has-error>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary rounded-pill mr-auto"
                                            v-show="!editCat"
                                            @click.prevent="addCategory"
                                        >Publish</button>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger rounded-pill mr-auto"
                                            v-show="editCat"
                                            @click.prevent="updateCategory"
                                        >Update</button>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-info rounded-pill ml-auto"
                                            v-show="editCat"
                                            @click.prevent="cancelUpdate"
                                        >Cancel</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-hover">
                                        <thead class="bg-primary text-light">
                                        <tr>
                                            <th scope="col" class="sort">Category Title</th>
                                            <th scope="col" class="sort">Slag</th>
                                            <th scope="col" class="sort">Status</th>
                                            <th scope="col" class="sort">Author</th>
                                            <th scoped="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list" v-for="(category, index) in categories.data" :key="index">
                                        <tr>
                                            <th class="text-capitalize">{{ category.name }}</th>
                                            <td>{{ category.name }}</td>
                                            <td>
                          <span class="badge badge-dot mr-4">
                            <span v-if="category.status === 'inactive'">
                              <i class="bg-warning"></i>
                            </span>

                            <span v-else>
                              <i class="bg-success"></i>
                            </span>
                            <span class="status">{{ category.status }}</span>
                          </span>
                                            </td>
                                            <td>{{ category.author.name }}</td>
                                            <td class="text-right">
                                                <div class="dropdown" data-toggle="dropdown">
                                                    <a
                                                        href="#"
                                                        class="action-item"
                                                        role="button"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button
                                                            class="dropdown-item"
                                                            @click.prevent="editCategory(category)"
                                                        >Edit</button>
                                                        <button
                                                            class="dropdown-item"
                                                            @click.prevent="deleteCategory(category.id)"
                                                        >Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
        <!-- Page title -->
        <div class="page-title">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                    <!-- Page title + Go Back button -->
                    <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Projects</h5>
                    </div>
                    <!-- Additional info -->
                    <div class="align-items-center ml-4 d-inline-flex">
                        <span class="h4 text-info mb-0 mr-2">{{ runningProjects }}</span>
                        <span class="text-sm opacity-7 text-white">Running projects</span>
                    </div>
                    <!-- Optional link -->
                    <a href="table-listing.html" class="text-sm text-info d-none d-lg-inline-block ml-4">See table</a>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                    <div class="actions actions-dark d-inline-block">
                        <button type="button" class="btn btn-sm btn-white text-dark rounded-pill mr-auto" @click.prevent="categoryButton">Categories</button>
                    </div>
                    <button class="btn btn-sm btn-white btn-icon-only rounded-circle ml-4" @click.prevent="addProjectButton">
                        <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Project cards -->
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-sm-6" v-for="(project, index) in projects.data" :key="index">
                <div class="card hover-shadow-lg">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ project.duration }} days</h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <div class="dropdown action-item" data-toggle="dropdown">
                                        <a href="#" class="action-item"><i class="fas fa-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item" @click.prevent="editProjectButton(project)">Edit</a>
                                            <a href="#" class="dropdown-item" @click.prevent="chageProjectLogo(project)">Change Logo</a>
                                            <a href="#" class="dropdown-item" @click.prevent="deleteProjectButton(project.project_id)">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center"><router-link :to="'/dashboard/project/' + project.slag" class="avatar rounded-circle avatar-lg hover-translate-y-n3">
                        <img alt="Image placeholder" v-if="project.logo" :src="project.logo" class="">
                        <img alt="Image placeholder" v-else src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/brand-avatar-1.png" class="">
                    </router-link>
                        <h5 class="h6 my-4">
                            <router-link :to="'/dashboard/project/' + project.slag">{{ project.name }}</router-link>
                        </h5>
                        <div class="avatar-group hover-avatar-ungroup mb-3">
                            <a href="#" class="avatar rounded-circle avatar-sm"  v-for="(dev, index) in project.devs" :key="index">
                                <img alt="Image placeholder" :src="dev.dev_image" class="">
                            </a>
                        </div>
                        <span class="clearfix"></span>
                        <span class="badge badge-pill badge-success text-capitalize">{{ project.status }}</span>
                    </div>
                    <div class="p-3 border-top">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="text-sm text-muted font-weight-600">Invoice #{{ project.invoice }}</span>
                                <div class="mt-3">
                                    <h6 class="mb-0">${{ project.ammount }}.00</h6>
                                    <span class="text-sm text-muted">Amount</span>
                                </div>
                            </div>
                            <div class="col-7">
                                <span class="text-sm text-muted">Start </span>
                                <h6 class="mb-0" style="font-size: .9rem">{{ project.starting_date }}</h6>
                                <span class="text-sm text-muted">Deadline</span>
                                <h6 class="mb-0" style="font-size: .9rem">{{ project.deadline }}</h6>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="actions d-flex justify-content-between px-4">
                            <a href="#" class="action-item">
                                <i class="fas fa-plus"></i>
                            </a>
                            <a href="#" class="action-item">
                                <i class="fas fa-comment"></i>
                            </a>
                            <a href="#" class="action-item text-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'
    export default {
        components:{
          DatePicker
        },
        data(){
            return{
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },

                message: 'Project List',
                projects:{},
                editCat: false,
                categories: {},
                categoryForm: new Form({
                    id: "",
                    name: "",
                    status: ""
                }),

                users: {},

                editProject: false,
                form : new Form({
                    'project_id' : '',
                    'name' : '',
                    'category_id' : '',
                    'logo' : '',
                    'customer_id' : '',
                    'reference_id' : '',
                    'invoice' : '',
                    'ammount' : '',
                    'starting_date' : '',
                    'deadline' : '',
                    'description' : '',
                    'status' : '',
                    'privacy' : ''

                }),

                logoUpdate : new Form({
                    'project_id' : '',
                    'newLogo' : '',
                    'logo' : '',
                })
            }
        },
        methods:{
            loadProjects(){
                axios.get('/api/projects')
                .then( ({data}) => {
                    this.projects = data
                });
            },

            loadUsers(){
                axios.get("/api/users").then(({ data }) => {
                    this.users = data;
                });
            },

            getCategories() {
                axios.get("/api/category").then(({ data }) => {
                    this.categories = data;
                });
            },

            //Categories
            categoryButton() {
                this.editCat = false;
                $("#category-modal").modal("show");
            },
            addCategory() {
                this.editCat = false;
                this.categoryForm
                    .post("/api/category")
                    .then(() => {
                        this.categoryForm.reset();
                        Toast.fire({
                            icon: "success",
                            title: "Category created successfully!"
                        });
                        Fire.$emit("loadCategoryModal");
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            editCategory(category) {
                this.editCat = true;
                this.categoryForm.reset();
                this.categoryForm.fill(category);
            },
            updateCategory() {
                this.categoryForm
                    .put("/api/category/" + this.categoryForm.id)
                    .then(() => {
                        Swal.fire("Updated!", "Update has been successful!.", "success");
                        this.editCat = false;
                        this.categoryForm.reset();
                        Fire.$emit("loadCategoryModal");
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
            cancelUpdate() {
                this.categoryForm.reset();
                this.editCat = false;
            },
            deleteCategory(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then(result => {
                    if (result.value) {
                        this.categoryForm
                            .delete("/api/category/" + id)
                            .then(() => {
                                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                                Fire.$emit("loadCategoryModal");
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    footer: ""
                                });
                            });
                    } else {
                        Fire.$emit("loadCategoryModal");
                        Console.log("Cancel button clicked");
                    }
                });
            },

            addProjectButton(){
                this.editProject = false;
                this.form.reset();
                $('#project-model').modal('show');
            },

            publishProject(){
                this.form.post('/api/projects')
                .then(() => {
                    Fire.$emit("loadProjectPage");
                    $('#project-model').modal('hide');
                    Toast.fire({
                        icon: "success",
                        title: "Project created successfully!"
                    });

                })
                .catch(error => {
                    console.log(error);
                });
            },

            editProjectButton(project){
                this.editProject = true;
                this.form.reset();
                $('#project-model').modal('show');
                this.form.fill(project);
            },

            deleteProjectButton(id){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then(result => {
                    if (result.value) {
                        this.form
                            .delete("/api/projects/" + id)
                            .then(() => {
                                Fire.$emit("loadProjectPage");
                                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    footer: ""
                                });
                            });
                    } else {
                        Fire.$emit("loadProjectPage");
                        Console.log("Cancel button clicked");
                    }
                });
            },

            uploadProjectLogo(e){
                const file = e.target.files[0];
                const reader = new FileReader();
                if (file["size"] < 2111775) {
                    reader.onloadend = file => {
                        this.form.logo = reader.result;
                        this.logoUpdate.newLogo = reader.result;
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

            updateProject(){
                this.form
                    .put("/api/projects/" + this.form.project_id)
                    .then(() => {
                        Fire.$emit("loadProjectPage");
                        $('#project-model').modal('hide');
                        Swal.fire("Updated!", "Update has been successful!.", "success");
                        this.editProject = false;
                        this.form.reset();
                    })
                    .catch(() => {
                        $('#project-model').modal('hide');
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            footer: ""
                        });
                    });
            },

            chageProjectLogo(project){
                this.logoUpdate.reset();
                $('#project-logo-change').modal('show');
                this.logoUpdate.fill(project)
            },

            updateProjectLogo(){
                if(this.logoUpdate.newLogo){
                    this.logoUpdate.put('/api/updatelogo/' + this.logoUpdate.project_id)
                        .then(() => {
                            Fire.$emit("loadProjectPage");
                            $('#project-logo-change').modal('hide');
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
            }

        },
        computed:{
            runningProjects(){
                return _.filter(this.projects.data, {'status': 'active'}).length;
            }
        },
        created() {
            this.getCategories();
            this.loadUsers();
            this.loadProjects();

            Fire.$on("loadCategoryModal", () => {
                this.loadProjects();
                this.getCategories();
                this.loadUsers();
            });

            Fire.$on("loadProjectPage", () => {
                this.loadProjects();
                this.getCategories();
                this.loadUsers();
            });
        }
    }
</script>
