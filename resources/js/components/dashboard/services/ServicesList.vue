<template>
  <div class="service__wrapper">
    <!-- Create project modal -->
    <div
      class="modal fade"
      id="modal-service-create"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editService">New Service</h5>
            <h5 class="modal-title" v-show="editService">Edit Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Service name -->
            <div class="form-group">
              <label class="form-control-label">Service Title</label>
              <input
                type="text"
                class="form-control"
                v-model="form.title"
                :class="{ 'is-invalid' : form.errors.has('title') }"
              />
              <has-error :form="form" field="title"></has-error>
            </div>
            <!-- Service short description -->
            <div class="form-group">
              <label class="form-control-label mb-0">Short description</label>
              <small
                class="form-text text-muted mb-2 mt-0"
              >This textarea will autosize while you type</small>
              <ckeditor
                :editor="editor"
                v-if="!editService"
                rows="1"
                v-model="form.short_description"
                :config="editorConfig"
                data-toggle="autosize"
                :class="{ 'is-invalid': form.errors.has('short_description') }"
              ></ckeditor>
              <ckeditor
                :editor="editor"
                v-if="editService"
                rows="5"
                v-model="form.short_description"
                :config="editorConfig"
                data-toggle="autosize"
                :class="{ 'is-invalid': form.errors.has('short_description') }"
              ></ckeditor>
              <has-error :form="form" field="short_description"></has-error>
            </div>
            <!-- Service Category and duration -->
            <div class="row mt-4 mb-3">
              <div class="col-md-6">
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
                    v-model="form.category"
                    :class="{'is-invalid': form.errors.has('category')}"
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
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span
                      class="input-group-text font-weight-bold text-info"
                      id="basic-addon1"
                    >Duration</span>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Duration in hours."
                    aria-label="Duration"
                    name="job_duration"
                    value
                    v-model="form.duration"
                    :class="{ 'is-invalid': form.errors.has('duration')}"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">hours</span>
                  </div>
                  <has-error :form="form" field="duration"></has-error>
                </div>
              </div>
            </div>
            <!-- Service Price and Image -->
            <div class="row mt-4 mb-3">
              <div class="col-md-6">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text font-weight-bold text-info">Price</span>
                  </div>
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Price"
                    aria-label="Duration"
                    name="job_price"
                    value
                    v-model="form.price"
                    :class="{ 'is-invalid': form.errors.has('price')}"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                  <has-error :form="form" field="price"></has-error>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group position-relative">
                  <div class="input-group-prepend">
                    <label class="input-group-text font-weight-bold text-info">Image</label>
                  </div>
                  <div class="custom-file">
                    <input
                      type="file"
                      class="custom-file-input"
                      name="serviceImage"
                      @change="uploadServicePhoto"
                    />
                    <label class="custom-file-label">Select Image</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Service privacy -->
            <div class="form-group">
              <label class="form-control-label">Service privacy</label>
              <div class="row">
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="project-privacy"
                      id="radio-project-1"
                      value="private"
                      v-model="form.status"
                      :class="{'is-invalid': form.errors.has('status')}"
                    />
                    <label
                      class="custom-control-label form-control-label text-muted"
                      for="radio-project-1"
                    >Private</label>
                  </div>
                </div>
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="project-privacy"
                      id="radio-project-2"
                      value="team"
                      v-model="form.status"
                      :class="{'is-invalid': form.errors.has('status')}"
                    />
                    <label
                      class="custom-control-label form-control-label text-muted"
                      for="radio-project-2"
                    >Team</label>
                  </div>
                </div>
                <div class="col-4">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="radio"
                      class="custom-control-input"
                      name="project-privacy"
                      id="radio-project-3"
                      value="public"
                      v-model="form.status"
                      :class="{'is-invalid': form.errors.has('status')}"
                    />
                    <label
                      class="custom-control-label form-control-label text-muted"
                      for="radio-project-3"
                    >Public</label>
                  </div>
                </div>
                <has-error :form="form" field="status"></has-error>
              </div>
            </div>
            <!-- Job description -->
            <div class="form-group">
              <label class="form-control-label mb-0">Job description</label>
              <small
                class="form-text text-muted mb-2 mt-0"
              >This textarea will autosize while you type</small>
              <ckeditor
                :editor="editor"
                v-if="!editService"
                rows="1"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.description"
                :class="{ 'is-invalid': form.errors.has('description') }"
              ></ckeditor>
              <ckeditor
                :editor="editor"
                v-if="editService"
                rows="7"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.description"
                :class="{ 'is-invalid': form.errors.has('description') }"
              ></ckeditor>
              <has-error :form="form" field="description"></has-error>
            </div>
            <!-- Responsibilities description -->
            <div class="form-group">
              <label class="form-control-label mb-0">Responsibilities & responsibilities_duties</label>
              <small
                class="form-text text-muted mb-2 mt-0"
              >This textarea will autosize while you type</small>
              <ckeditor
                :editor="editor"
                v-if="!editService"
                rows="1"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.responsibilities_duties"
                :class="{ 'is-invalid': form.errors.has('responsibilities_duties')}"
              ></ckeditor>
              <ckeditor
                :editor="editor"
                v-if="editService"
                rows="10"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.responsibilities_duties"
                :class="{ 'is-invalid': form.errors.has('responsibilities_duties')}"
              ></ckeditor>
              <has-error :form="form" field="responsibilities_duties"></has-error>
            </div>
            <!-- Required Things -->
            <div class="form-group">
              <label class="form-control-label mb-0">Required Things:</label>
              <small
                class="form-text text-muted mb-2 mt-0"
              >This textarea will autosize while you type</small>
              <ckeditor
                :editor="editor"
                v-if="!editService"
                rows="1"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.required_things"
                :class="{ 'is-invalid': form.errors.has('required_things')}"
              ></ckeditor>
              <ckeditor
                :editor="editor"
                v-if="editService"
                rows="10"
                :config="editorConfig"
                data-toggle="autosize"
                v-model="form.required_things"
                :class="{ 'is-invalid': form.errors.has('required_things')}"
              ></ckeditor>
              <has-error :form="form" field="required_things"></has-error>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-sm btn-primary rounded-pill mr-auto"
              v-show="!editService"
              @click.prevent="publishService"
            >Publish</button>
            <button
              type="button"
              class="btn btn-sm btn-primary rounded-pill mr-auto"
              v-show="editService"
              @click.prevent="updateService"
            >Update</button>
            <button
              type="button"
              class="btn btn-sm btn-danger rounded-pill"
              v-show="editService"
              data-dismiss="modal"
              @click.prevent="deleteServiceButton(form.id)"
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
    <div class="page-title mb-5">
      <div class="row justify-content-between align-items-center">
        <div
          class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0"
        >
          <!-- Page title + Go Back button -->
          <div class="d-inline-block">
            <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Services</h5>
          </div>
          <!-- Additional info -->
          <div class="align-items-center ml-4 d-inline-flex">
            <span class="h4 text-info mb-0 mr-2">{{ allActiveServiceCount }}</span>
            <span class="text-sm opacity-7 text-white">active services</span>
          </div>
          <!-- Additional info -->
          <div class="align-items-center ml-4 d-inline-flex">
            <span class="h4 text-info mb-0 mr-2">{{ allInactiveServiceCount }}</span>
            <span class="text-sm opacity-7 text-white">inactive services</span>
          </div>
        </div>
        <div
          class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end"
        >
          <div class="actions actions-dark d-inline-block">
            <button
              type="button"
              class="btn btn-sm btn-white text-dark rounded-pill mr-auto"
              @click.prevent="categoryButton"
            >Categories</button>
          </div>
          <button
            class="btn btn-sm btn-white btn-icon-only rounded-circle ml-4"
            @click.prevent="addServiceButton"
          >
            <span class="btn-inner--icon">
              <i class="fas fa-plus"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
    <!-- Filter -->
    <div class="row">
      <div class="col-md-8">
        <!-- Select Category -->
        <div class="form-group">
          <select class="custom-select bg-light change-select" v-model="multiSelectValue">
            <option value selected>All Categories</option>
            <option
              v-for="(categorySelect, index) in categories.data"
              :key="index"
              :value="categorySelect.id"
              v-if="categorySelect.status === 'active'"
            >{{ categorySelect.name }}</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <!-- Select Privacy -->
        <div class="form-group">
          <select class="custom-select bg-light change-select" v-model="servicePrivacy">
            <option value="public" selected>Public</option>
            <option value="private">Private</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Listing -->
    <div class="card">
      <!-- Card header -->
      <div class="card-header actions-toolbar border-0">
        <div class="actions-search" id="actions-search">
          <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend">
              <span class="input-group-text bg-transparent">
                <i class="fas fa-search"></i>
              </span>
            </div>
            <input
              type="text"
              class="form-control form-control-flush"
              placeholder="Type and hit enter ..."
            />
            <div class="input-group-append">
              <a
                href="#"
                class="input-group-text bg-transparent"
                data-action="search-close"
                data-target="#actions-search"
              >
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="row justify-content-between align-items-center">
          <div class="col">
            <h6 class="d-inline-block mb-0">One time services</h6>
          </div>
          <div class="col text-right">
            <div class="actions">
              <a
                href="#"
                class="action-item mr-3"
                data-action="search-open"
                data-target="#actions-search"
              >
                <i class="fas fa-search"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- Table -->
      <div class="table-responsive">
        <table class="table align-items-center">
          <thead>
            <tr>
              <th scope="col">Service Title</th>
              <th scope="col">Category</th>
              <th scope="col">Duration</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
              <th scope="col">Rating</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody
            class="list"
            v-for="(service, index) in services.data"
            :key="index"
            v-show="multiSelectValue === service.category.id || multiSelectValue === ''"
          >
            <tr v-if="service.category.status === 'active' && servicePrivacy === service.status">
              <th scope="row">
                <div class="media align-items-center">
                  <div>
                    <span v-if="service.image">
                      <img
                        alt="Image placeholder"
                        :src="service.image"
                        class="avatar rounded-circle"
                      />
                    </span>
                    <span v-else>
                      <img
                        alt="Image placeholder"
                        :src="'/images/services/default.png'"
                        class="avatar rounded-circle"
                      />
                    </span>
                  </div>
                  <div class="media-body ml-4">
                    <a
                      href="overview.html"
                      class="name mb-0 h6 text-sm"
                    >{{ service.title | limitTitle}}</a>
                  </div>
                </div>
              </th>
              <td class="budget text-capitalize">{{ service.category.name }}</td>
              <td>{{ service.duration }} hours</td>
              <td>${{ service.price }}</td>
              <td>
                <span class="badge badge-dot mr-4">
                  <span v-if="service.status === 'private'">
                    <i class="bg-warning"></i>
                  </span>
                  <span v-else-if="service.status === 'team'">
                    <i class="bg-danger"></i>
                  </span>
                  <span v-else>
                    <i class="bg-success"></i>
                  </span>

                  <span class="status">{{ service.status }}</span>
                </span>
              </td>
              <td>
                <star-rating :rating="service.rating" :show-rating="false" :star-size="15"></star-rating>
              </td>
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
                    <button class="dropdown-item" @click.prevent="editServiceButton(service)">Edit</button>
                    <button
                      @click.prevent="deleteServiceButton(service.id)"
                      class="dropdown-item"
                    >Delete</button>
                    <button class="dropdown-item">Preview</button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import StarRating from "vue-star-rating";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  components: {
    StarRating
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
      multiSelectValue: "",
      servicePrivacy: "public",
      editCat: false,
      categories: {},
      categoryForm: new Form({
        id: "",
        name: "",
        status: ""
      }),

      editService: false,
      services: {},
      form: new Form({
        id: "",
        title: "",
        short_description: "",
        category: "",
        duration: "",
        price: "",
        image: "",
        status: "",
        description: "",
        responsibilities_duties: "",
        required_things: ""
      })
    };
  },

  methods: {
    getCategories() {
      axios.get("/api/category").then(({ data }) => {
        this.categories = data;
      });
    },

    getServices() {
      axios.get("/api/service").then(({ data }) => {
        this.services = data;
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

    //Services
    addServiceButton() {
      this.editService = false;
      this.form.reset();
      $("#modal-service-create").modal("show");
    },
    uploadServicePhoto(e) {
      const file = e.target.files[0];
      const reader = new FileReader();
      if (file["size"] < 2111775) {
        reader.onloadend = file => {
          this.form.image = reader.result;
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
    publishService() {
      this.form
        .post("/api/service")
        .then(() => {
          $("#modal-service-create").modal("hide");
          Fire.$emit("loadServicePage");
          Toast.fire({
            icon: "success",
            title: "Post created successfully!"
          });
        })
        .catch(error => {
          console.log("service render error", error);
        });
    },
    editServiceButton(service) {
      this.editService = true;
      this.form.reset();
      $("#modal-service-create").modal("show");
      this.form.fill(service);
    },
    updateService() {
      this.form
        .put("/api/service/" + this.form.id)
        .then(() => {
          $("#modal-service-create").modal("hide");
          Swal.fire("Updated!", "Update has been successful!.", "success");
          this.$Progress.finish();
          Fire.$emit("loadServicePage");
        })
        .catch(() => {
          this.$Progress.fail();
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!",
            footer: ""
          });
        });
    },
    deleteServiceButton(id) {
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
            .delete("/api/service/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              Fire.$emit("loadServicePage");
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
          console.log("Cancel Pressed");
          Fire.$emit("loadServicePage");
        }
      });
    }
  },

  computed: {
    allActiveServiceCount() {
      let activeServiceCount = _.filter(this.services.data, [
        "status",
        "public"
      ]);
      return activeServiceCount.length;
    },
    allInactiveServiceCount() {
      let inactiveServiceCount = _.filter(this.services.data, [
        "status",
        "private"
      ]);
      return inactiveServiceCount.length;
    }
  },

  created() {
    this.getCategories();
    this.getServices();

    Fire.$on("loadServicePage", () => {
      this.getServices();
      this.getCategories();
    });

    Fire.$on("loadCategoryModal", () => {
      this.getServices();
      this.getCategories();
    });
  }
};
</script>
<style lang="scss" scoped>
.change-select {
  font-size: 1.2rem;
  color: #6e00ff;
  font-weight: bold;
}
</style>
