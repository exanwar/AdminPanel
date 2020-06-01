<template>
  <div class="blog__wrapper">
    <!-- Create blo modal -->
    <div class="modal fade" id="modal-blog-create" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editPost">New Blog Post</h5>
            <h5 class="modal-title" v-show="editPost">Edit Blog Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <!-- Project name -->
              <div class="form-group">
                <label class="form-control-label">Blog title</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.title"
                  :class="{ 'is-invalid': form.errors.has('title') }"
                />
                <has-error class="text-danger" :form="form" field="title"></has-error>
              </div>
              <!-- Blog Category and Image -->
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
                      :class="{ 'is-invalid': form.errors.has('category')}"
                    >
                      <option value selected>Select a category</option>
                      <option
                        v-for="(category, index) in categories.data"
                        :key="index"
                        :value="category.id"
                      >{{ category.name }}</option>
                    </select>
                    <has-error class="text-danger" :form="form" field="category"></has-error>
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
                        name="postImage"
                        @change="uploadBlogPhoto"
                      />
                      <label class="custom-file-label">Select Image</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Project privacy -->
              <div class="form-group">
                <label class="form-control-label">Project privacy</label>
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
                        value="public"
                        v-model="form.status"
                        checked
                      />
                      <label
                        class="custom-control-label form-control-label text-muted"
                        for="radio-project-2"
                      >Public</label>
                    </div>
                  </div>
                  <div class="col-4">
                    <div v-if="form.image">
                      <img :src="form.image" class="img-fluid" alt="preview" />
                    </div>
                  </div>
                </div>
              </div>
              <!-- Project description -->
              <div class="form-group">
                <label class="form-control-label mb-0">Project description</label>
                <small
                  class="form-text text-muted mb-2 mt-0"
                >This textarea will autosize while you type</small>
                <ckeditor
                  :editor="editor"
                  v-if="editPost"
                  rows="10"
                  v-model="form.description"
                  :config="editorConfig"
                  data-toggle="autosize"
                  :class="{ 'is-invalid': form.errors.has('description') }"
                ></ckeditor>
                <ckeditor
                  :editor="editor"
                  v-if="!editPost"
                  rows="1"
                  v-model="form.description"
                  :config="editorConfig"
                  data-toggle="autosize"
                  :class="{ 'is-invalid': form.errors.has('description') }"
                ></ckeditor>
                <has-error class="text-danger" :form="form" field="description"></has-error>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-sm btn-primary rounded-pill mr-auto"
              v-show="!editPost"
              @click.prevent="publishPost"
            >Publish</button>
            <button
              type="button"
              class="btn btn-sm btn-primary rounded-pill mr-auto"
              v-show="editPost"
              @click.prevent="updatePost"
            >Update</button>
            <button
              type="button"
              class="btn btn-sm btn-danger rounded-pill"
              v-show="editPost"
              data-dismiss="modal"
              @click.prevent="deletePostButton(form.id)"
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
    <div class="page-title">
      <div class="row justify-content-between align-items-center">
        <div
          class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0"
        >
          <!-- Page title + Go Back button -->
          <div class="d-inline-block">
            <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Blog</h5>
          </div>
          <!-- Additional info -->
          <div class="align-items-center ml-4 d-inline-flex">
            <span class="h4 text-info mb-0 mr-2">{{ activePost }}</span>
            <span class="text-sm opacity-7 text-white">active posts</span>
          </div>
          <!-- Additional info -->
          <div class="align-items-center ml-4 d-inline-flex">
            <span class="h4 text-info mb-0 mr-2">{{ inactivePost }}</span>
            <span class="text-sm opacity-7 text-white">inactive posts</span>
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
            @click.prevent="addPostButton"
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
          <select class="custom-select bg-light change-select" v-model="blogPrivacy">
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
            <h6 class="d-inline-block mb-0">Blog Posts</h6>
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
              <th scope="col" class="sort" data-sort="name" style="width:100px">Post Title</th>
              <th scope="col" class="sort" data-sort="budget">Category</th>
              <th scope="col" class="sort" data-sort="status">Status</th>
              <th scope="col" class="sort" data-sort="status">Author</th>
              <th scope="col">Posted On</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody
            class="list"
            v-for="post in posts.data"
            :key="post.id"
            v-show="multiSelectValue === post.category.id || multiSelectValue === ''"
            v-if="post.category.status === 'active'"
          >
            <tr v-if="blogPrivacy === post.status">
              <th scope="row">
                <div class="media align-items-center">
                  <div>
                    <span v-if="post.image === null || post.image === ''">
                      <img
                        alt="Image placeholder"
                        :src="'/images/posts/default.png'"
                        class="avatar rounded-circle"
                      />
                    </span>
                    <span v-else>
                      <img
                        alt="Image placeholder"
                        :src="'/images/posts/'+ post.image"
                        class="avatar rounded-circle"
                      />
                    </span>
                  </div>
                  <div class="media-body ml-4">
                    <a
                      href="overview.html"
                      class="name mb-0 h6 text-sm"
                    >{{ post.title | limitTitle}}</a>
                  </div>
                </div>
              </th>
              <td class="budget text-capitalize">{{ post.category.name }}</td>
              <td>
                <span class="badge badge-dot mr-4">
                  <span v-if="post.status === 'private'">
                    <i class="bg-warning"></i>
                  </span>
                  <span v-else>
                    <i class="bg-success"></i>
                  </span>

                  <span class="status">{{ post.status }}</span>
                </span>
              </td>
              <td>
                <div class="list-group list-group-flush">
                  <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                      <div>
                        <span class="avatar bg-primary text-white rounded-circle">
                          <img
                            alt="Img Placeholder"
                            v-if="post.author.image === '' || post.author.image === null"
                            :src="'/images/users/default.jpg'"
                          />
                          <img
                            alt="Img Placeholder"
                            v-else
                            :src="'/images/users/'+post.author.image"
                          />
                        </span>
                      </div>
                      <div class="flex-fill ml-3">
                        <div class="h6 text-sm mb-0">
                          {{ post.author.name }}
                          <small
                            class="ml-2 float-right text-muted"
                          >{{ post.created_at | momentAgo }}</small>
                        </div>
                        <p class="text-sm lh-140 mb-0">{{ post.author.email }}</p>
                      </div>
                    </div>
                  </a>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="completion mr-2">{{ post.created_at | myDate }}</span>
                </div>
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
                    <button class="dropdown-item" @click.prevent="editPostButton(post)">Edit</button>
                    <button @click.prevent="deletePostButton(post.id)" class="dropdown-item">Delete</button>
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
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
      multiSelectValue: "",
      blogPrivacy: "public",
      editPost: false,
      editCat: false,
      posts: {},
      categories: {},
      form: new Form({
        id: "",
        title: "",
        category: "",
        status: "",
        description: "",
        image: "",
        author: ""
      }),
      categoryForm: new Form({
        id: "",
        name: "",
        status: ""
      })
    };
  },
  methods: {
    //Category
    categoryButton() {
      $("#category-modal").modal("show");
      this.editCat = false;
    },

    addCategory() {
      this.editCat = false;
      this.categoryForm
        .post("/api/category")
        .then(() => {
          this.categoryForm.reset();
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
          Toast.fire({
            icon: "success",
            title: "Category created successfully!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editCategory(category) {
      this.editCat = true;
      this.categoryForm.reset();
      this.categoryForm.fill(category);
    },
    updateCategory() {
      this.$Progress.start();
      this.categoryForm
        .put("/api/category/" + this.categoryForm.id)
        .then(() => {
          Swal.fire("Updated!", "Update has been successful!.", "success");
          this.editCat = false;
          this.categoryForm.reset();
          this.$Progress.finish();
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
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
              Fire.$emit("loadPage");
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
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
          Console.log("Cancel button clicked");
        }
      });
    },

    //POST
    addPostButton() {
      this.editPost = false;
      this.form.reset();
      $("#modal-blog-create").modal("show");
    },
    loadPosts() {
      axios.get("/api/blog").then(({ data }) => {
        this.posts = data;
      });
    },
    loadCategories() {
      axios.get("/api/category").then(({ data }) => {
        this.categories = data;
      });
    },
    uploadBlogPhoto(e) {
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
    publishPost() {
      this.$Progress.start();
      this.form
        .post("/api/blog")
        .then(() => {
          $("#modal-blog-create").modal("hide");
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
          Toast.fire({
            icon: "success",
            title: "Post created successfully!"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    editPostButton(post) {
      this.editPost = true;
      this.form.reset();
      $("#modal-blog-create").modal("show");
      this.form.fill(post);
    },
    updatePost() {
      this.$Progress.start();
      this.form
        .put("/api/blog/" + this.form.id)
        .then(() => {
          $("#modal-blog-create").modal("hide");
          Swal.fire("Updated!", "Update has been successful!.", "success");
          this.$Progress.finish();
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
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
    deletePostButton(id) {
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
            .delete("/api/blog/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              this.$Progress.finish();
              Fire.$emit("loadPage");
              Fire.$emit("loadCategoryModal");
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
        } else {
          Fire.$emit("loadPage");
          Fire.$emit("loadCategoryModal");
          this.$Progress.finish();
        }
      });
    }
  },
  computed: {
    activePost() {
      let activePostCount = _.filter(this.posts.data, ["status", "public"]);
      return activePostCount.length;
    },
    inactivePost() {
      return _.filter(this.posts.data, ["status", "private"]).length;
    }
  },
  created() {
    this.loadPosts();
    this.loadCategories();

    Fire.$on("loadPage", () => {
      this.loadPosts();
      this.loadCategories();
    });

    Fire.$on("loadCategoryModal", () => {
      this.loadCategories();
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
