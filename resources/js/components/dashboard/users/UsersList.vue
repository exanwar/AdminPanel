<template>
  <div class="users_list__wrapper">
    <!-- User Modal -->
    <div class="modal fade" id="user-model" tabindex="-2" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new user</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-12">
              <div class="row">
                <div class="col-md-7 col-sm-12">
                  <div class="form-group">
                    <label class="form-control-label">Full Name</label>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Full name"
                      v-model="form.name"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error class="text-danger" :form="form" field="name"></has-error>
                  </div>
                </div>
                <div class="col-md-5 col-sm-12">
                  <div class="form-group">
                    <label class="form-control-label">Username</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                      </div>
                      <input
                        type="text"
                        class="form-control"
                        placeholder="Username"
                        v-model="form.username"
                        :class="{ 'is-invalid' : form.errors.has('username')}"
                      />
                      <has-error class="text-danger" :form="form" field="username"></has-error>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="form-control-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Email address"
                      v-model="form.email"
                      :class="{ 'is-invalid' : form.errors.has('email')}"
                    />
                    <has-error class="text-danger" :form="form" field="email"></has-error>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="form-control-label">Image</label>
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
                      <label class="custom-file-label">Select Image</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <label class="form-control-label">User role</label>
                  <select
                    class="custom-select bg-light"
                    name="userRole"
                    id="userRole"
                    v-model="form.role"
                    :class="{ 'is-invalid': form.errors.has('role')}"
                  >
                    <option value selected>Select a Role</option>
                    <option value="admin">Admin</option>
                    <option value="customer">User</option>
                    <option value="dev">Developer</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12" v-if="form.role === 'dev' || form.role === 'admin'">
                  <label class="form-control-label">Developer type</label>
                  <select
                    class="custom-select bg-light"
                    name="userRole"
                    id="userStatus"
                    v-model="form.devType"
                    :class="{ 'is-invalid': form.errors.has('role')}"
                  >
                    <option value selected>Select a status</option>
                    <option value="BEnd">Back-end developer</option>
                    <option value="FEnd">Front-end developer</option>
                    <option value="fullStack">Full-stack developer</option>
                  </select>
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
                              v-model="form.facebook"
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
                              v-model="form.whats_app"
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
                              v-model="form.skype"
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
                              v-model="form.instagram"
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
                              v-model="form.linkedin"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label class="form-control-label">Phone</label>
                          <VuePhoneNumberInput v-model="form.phone"></VuePhoneNumberInput>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="form-control-label">Password</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-key"></i>
                        </span>
                      </div>
                      <input
                        type="password"
                        class="form-control"
                        placeholder="********"
                        v-model="form.password"
                      />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <a
                            href="#"
                            data-toggle="password-text"
                            id="input-password"
                            data-target="#input-password"
                          >
                            <i class="fas fa-eye"></i>
                          </a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="form-control-label">Confirm password</label>
                    <div class="input-group input-group-merge">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-key"></i>
                        </span>
                      </div>
                      <input
                        type="password"
                        class="form-control"
                        id="input-password-confirm"
                        placeholder="********"
                        v-model="form.cpass"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="custom-control custom-checkbox my-3">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="check-terms"
                  v-model="form.confirm_check"
                />
                <label class="custom-control-label" for="check-terms">
                  All informations
                  <a href="#">have been checked for twice.</a>
                </label>
              </div>
              <div class="mt-4">
                <button
                  type="button"
                  class="btn btn-sm btn-primary btn-icon rounded-pill"
                  @click.prevent="addUser"
                >
                  <span class="btn-inner--text">Create account</span>
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
    <!-- Page title -->
    <div class="page-title mb-5">
      <div class="row justify-content-between align-items-center">
        <div
          class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0"
        >
          <!-- Page title + Go Back button -->
          <div class="d-inline-block">
            <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Users</h5>
          </div>
          <!-- Additional info -->
          <div class="align-items-center ml-4 d-inline-flex">
            <span class="h4 text-info mb-0 mr-2">9</span>
            <span class="text-sm opacity-7 text-white">New users</span>
          </div>
          <!-- Optional link -->
          <a
            href="table-listing.html"
            class="text-sm text-info d-none d-lg-inline-block ml-4"
          >See table</a>
        </div>
        <div
          class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end"
        >
          <!-- Filter input -->
          <form class="bg-neutral rounded-pill d-inline-block">
            <div class="input-group input-group-sm input-group-merge input-group-flush">
              <div class="input-group-prepend">
                <span class="input-group-text bg-transparent">
                  <i class="fas fa-filter"></i>
                </span>
              </div>
              <input
                type="text"
                class="form-control form-control-flush"
                placeholder="Filter results"
              />
            </div>
          </form>
          <button
            class="btn btn-sm btn-white btn-icon-only rounded-circle ml-4"
            @click.prevent="addUserButton"
          >
            <span class="btn-inner--icon">
              <i class="fas fa-plus"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <select class="custom-select bg-light change-select" v-model="userRole">
            <option value selected>All users</option>
            <option value="admin">Admin</option>
            <option value="dev">Developers</option>
            <option value="customer">Member</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <select
            class="custom-select bg-light change-select"
            v-model="developerType"
            v-show="userRole === 'dev' || userRole === 'admin'"
          >
            <option value v-if="userRole === 'admin'" selected>All Admins</option>
            <option value v-if="userRole === 'dev'" selected>All Developers</option>
            <option value="FEnd" selected>Front End Developer</option>
            <option value="BEnd">Back End Developer</option>
            <option value="fullStack">Full Stack Developer</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div
        class="col-lg-3 col-sm-6"
        v-for="(user, index) in users"
        :key="index"
        v-show="userRole === user.role || userRole === ''"
      >
        <span v-if="userRole === 'dev' || userRole === 'admin'">
          <span v-if="developerType === user.devType || developerType === ''">
            <div class="card hover-shadow-lg">
              <div class="card-body text-center">
                <div class="avatar-parent-child">
                  <img
                    alt="Image placeholder"
                    v-if="user.image === '' || user.image === null"
                    :src="'/images/users/default.jpg'"
                    class="avatar rounded-circle avatar-lg"
                  />
                  <img
                    alt="Image placeholder"
                    v-else
                    :src="'/images/users/'+user.image"
                    class="avatar rounded-circle avatar-lg"
                  />
                  <span class="avatar-child avatar-badge bg-success"></span>
                </div>
                <h5 class="h6 mt-3 mb-1 text-info font-weight-bold">@{{ user.username }}</h5>
                <h5 class="h6 mt-1 mb-0">
                  <router-link :to="'/dashboard/user/'+ user.id">{{ user.name }}</router-link>
                </h5>
                <a href="#" class="d-block text-sm text-muted mb-3">{{ user.email }}</a>
                <div class="actions d-flex justify-content-between px-4">
                  <a href="#" class="action-item">
                    <i class="fas fa-user-edit"></i>
                  </a>
                  <a href="#" class="action-item">
                    <i class="fas fa-bell"></i>
                  </a>
                  <a href="#" class="action-item">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </div>
              </div>
              <div class="card-body border-top">
                <div class="row justify-content-between align-items-center">
                  <div class="col-6">
                    <div style="max-width: 120px;">
                      <div
                        class="spark-chart"
                        data-toggle="spark-chart"
                        data-type="line"
                        data-height="50"
                        data-color="success"
                        data-dataset="[47, 94, 24, 18, 26, 65, 31, 47, 10, 44, 45]"
                      ></div>
                    </div>
                  </div>
                  <div class="col-auto text-center">
                    <span class="d-block h4 mb-0">4</span>
                    <span class="d-block text-sm text-muted">Open tasks</span>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="actions d-flex justify-content-between">
                  <a href="#" class="action-item">
                    <span class="btn-inner--icon">Projects</span>
                  </a>
                  <a href="#" class="action-item">
                    <span class="btn-inner--icon">See profile</span>
                  </a>
                </div>
              </div>
            </div>
          </span>
        </span>
        <span v-else>
          <div class="card hover-shadow-lg">
            <div class="card-body text-center">
              <div class="avatar-parent-child">
                <router-link :to="'/dashboard/user/'+ user.username">
                  <img
                    alt="Image placeholder"
                    v-if="user.image === '' || user.image === null"
                    :src="'/images/users/default.jpg'"
                    class="avatar rounded-circle avatar-lg"
                  />
                  <img
                    alt="Image placeholder"
                    v-else
                    :src="user.image"
                    class="avatar rounded-circle avatar-lg"
                  />
                  <span class="avatar-child avatar-badge bg-success"></span>
                </router-link>
              </div>
              <h5 class="h6 mt-3 mb-1 font-weight-bold">
                <router-link
                  :to="'/dashboard/user/'+ user.username"
                  class="text-info"
                >@{{ user.username }}</router-link>
              </h5>
              <h5 class="h6 mt-1 mb-0">
                <router-link
                  :to="'/dashboard/user/'+ user.username"
                  class="text-warning"
                >{{ user.name }}</router-link>
              </h5>
              <router-link
                to="'/dashboard/user/' + user.id"
                class="d-block text-sm text-muted mb-3"
              >{{ user.email }}</router-link>
              <div class="actions d-flex justify-content-between px-4">
                <a href="#" class="action-item">
                  <i class="fas fa-user-edit"></i>
                </a>
                <a href="#" class="action-item">
                  <i class="fas fa-bell"></i>
                </a>
                <a href="#" class="action-item">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </div>
            </div>
            <div class="card-body border-top">
              <div class="row justify-content-between align-items-center">
                <div class="col-6">
                  <div style="max-width: 120px;">
                    <div
                      class="spark-chart"
                      data-toggle="spark-chart"
                      data-type="line"
                      data-height="50"
                      data-color="success"
                      data-dataset="[47, 94, 24, 18, 26, 65, 31, 47, 10, 44, 45]"
                    ></div>
                  </div>
                </div>
                <div class="col-auto text-center">
                  <span class="d-block h4 mb-0">4</span>
                  <span class="d-block text-sm text-muted">Open tasks</span>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="actions d-flex justify-content-between">
                <a href="#" class="action-item">
                  <span class="btn-inner--icon">Projects</span>
                </a>
                <a href="#" class="action-item">
                  <span class="btn-inner--icon">See profile</span>
                </a>
              </div>
            </div>
          </div>
        </span>
      </div>
      <div class="col-lg-3 col-sm-6">
        <div class="card card-fluid card-placeholder align-items-center justify-content-center">
          <div class="text-center">
            <a href class="stretched-link" @click.prevent="addUserButton">
              <i class="fas fa-plus fa-2x text-muted"></i>
              <span class="h6 text-muted d-block mt-3">Add new user</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import VuePhoneNumberInput from "vue-phone-number-input";
export default {
  components: {
    VuePhoneNumberInput
  },

  data() {
    return {
      userRole: "",
      developerType: "",
      users: {},
      form: new Form({
        id: "",
        username: "",
        name: "",
        email: "",
        role: "",
        devType: "",
        image: "",
        facebook: "",
        whats_app: "",
        skype: "",
        instagram: "",
        linkedin: "",
        phone: "",
        password: "",
        cpass: "",
        confirm_check: ""
      })
    };
  },
  methods: {
    getUsers() {
      axios.get("/api/users").then(({ data }) => {
        this.users = data;
      });
    },

    addUserButton() {
      $("#user-model").modal("show");
    },
    uploadUserPhoto(e) {
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

    addUser() {
      if (this.form.confirm_check) {
        if (this.form.password === this.form.cpass) {
          this.form
            .post("/api/users")
            .then(() => {
              Fire.$emit("LoadUserList");
              $("#user-model").modal("hide");
              console.log("Success");
            })
            .catch(error => {
              console.log(error);
            });
        } else {
          console.log("password didn't match");
        }
      } else {
        console.log("Check the check box");
      }
    }
  },

  created() {
    this.getUsers();

    Fire.$on("LoadUserList", () => {
      this.getUsers();
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
