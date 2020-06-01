<template>
  <div class="project_details__wrapper">
    <!-- Team selection modal -->
    <div class="modal fade" id="modal-users" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header align-items-center">
            <div class="modal-title">
              <h6 class="mb-0">Select team</h6>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Connections -->
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <select class="custom-select bg-light change-select" v-model="developerType">
                    <option value selected>All Developers</option>
                    <option value="FEnd">Front End Developers</option>
                    <option value="BEnd">Back End Developers</option>
                    <option value="fullStack">Full Stack Developers</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div
                class="col-6 col-md-3"
                v-for="(user, index) in users"
                :key="index"
                v-if="user.role == 'admin' || user.role === 'dev'"
              >
                <span v-if="developerType === user.devType || developerType === ''">
                  <div class="card">
                    <div class="card-body text-center">
                      <div class="avatar-parent-child">
                        <a href="#" class="avatar avatar-lg rounded-circle">
                          <img alt="Image placeholder" v-if="user.image" :src="user.image" />
                          <img alt="Image placeholder" v-else src="/images/users/default.jpg" />
                        </a>
                      </div>
                      <h6 class="text-sm my-3">{{ user.name }}</h6>
                      <button type="button" class="btn btn-xs btn-secondary" @click.prevent="addDevToProject(user)">Add</button>
                    </div>
                  </div>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-edit-todo" tab-index="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <div class="modal-title">
                        <h6 class="mb-0">Update todo</h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>
                            Updated todo
                        </label>
                        <input type="text" v-model="todoForm.todo" class="form-control" placeholder="Please write todo here" >
                    </div>
                    <div class="mt-4">
                        <button
                            type="button"
                            class="btn btn-sm btn-danger btn-icon rounded-pill" @click.prevent="updateTodo">
                            <span class="btn-inner--text">Update todo</span>
                            <span class="btn-inner--icon">
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </span>
                        </button>
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
    <div v-for="(project, index) in projectData" :key="index">
          <!-- Page title -->
          <div class="page-title">
              <div class="row justify-content-between align-items-center">
                  <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                      <!-- Page title + Go Back button -->
                      <div class="d-inline-block">
                          <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">{{ project.name }}</h5>
                      </div>
                      <!-- Additional info -->
                  </div>
                  <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
                      <div class="avatar-group">
                          <a href="#" class="avatar rounded-circle avatar-sm"  v-for="(dev, index) in project.devs" :key="index">
                              <img alt="Image placeholder" :src="dev.dev_image" class="">
                          </a>
                      </div>
                      <a href="#modal-users" class="btn btn-sm btn-white rounded-circle btn-icon-only ml-2" data-toggle="modal">
                          <span class="btn-inner--icon"><i class="fas fa-user-plus"></i></span>
                      </a>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-xl-3 col-sm-6">
                  <!-- Stats card -->
                  <div class="card card-stats border-0">
                      <!-- Card body -->
                      <div class="card-body">
                          <div class="row">
                              <div class="col">
                                  <div class="col">
                                      <h6 class="text-muted mb-1">Project value</h6>
                                      <span class="h3 font-weight-bold mb-0 ">${{ project.ammount }}</span>
                                  </div>
                              </div>
                              <div class="col-auto">
                                  <div class="progress-circle progress-sm" id="progress-circle-1" data-progress="40" data-text="40%" data-color="primary"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Project performance -->
                  <div class="card">
                      <div class="card-body">
                          <div class="">
                              <div class="row">
                                  <div class="col-6">
                                      <h6 class="mb-0">{{ totalTodosDone }}</h6>
                                      <span class="text-sm text-muted">Tasks done</span>
                                  </div>
                                  <div class="col-6 text-right">
                                    <span class="badge badge-pill badge-success">Good</span>
                                  </div>
                              </div>
                          </div>
                          <div class="w-100 pt-4 pb-5">
                              <div class="spark-chart" data-toggle="spark-chart" data-color="info" data-dataset="[47, 94, 24, 18, 26, 65, 31, 47, 10, 44, 45]"></div>
                          </div>
                          <div class="progress-wrapper mb-3">
                              <small class="progress-label">Starting</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-info" role="progressbar" :aria-valuenow="startingDonePerentage" aria-valuemin="0" aria-valuemax="100" :style="'width: '+startingDonePerentage+'%;'"></div>
                              </div>
                          </div>
                          <div class="progress-wrapper">
                              <small class="progress-label">Intermediate</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-info" role="progressbar" :aria-valuenow="intermediateDonePerentage" aria-valuemin="0" aria-valuemax="100" :style="'width: '+intermediateDonePerentage+'%;'"></div>
                              </div>
                          </div>
                          <div class="progress-wrapper">
                              <small class="progress-label">Finalizing</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-info" role="progressbar" :aria-valuenow="finalizingDonePerentage" aria-valuemin="0" aria-valuemax="100" :style="'width: '+finalizingDonePerentage+'%;'"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                  <!-- Stats card -->
                  <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                          <div class="row">
                              <div class="col">
                                  <h6 class="text-muted mb-1">Total tasks</h6>
                                  <span class="h3 font-weight-bold mb-0 ">{{ totalTodos }}</span>
                              </div>
                              <div class="col-auto">
                                  <div class="progress-circle progress-sm" id="progress-circle-2" data-progress="60" data-text="60%" data-color="primary"></div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Project performance -->
                  <div class="card">
                      <div class="card-body">
                          <div class="">
                              <div class="row">
                                  <div class="col-6">
                                      <h6 class="mb-0">642</h6>
                                      <span class="text-sm text-muted">Hours spent</span>
                                  </div>
                                  <div class="col-6 text-right">
                                    <span class="badge badge-pill badge-danger">At risk</span>
                                  </div>
                              </div>
                          </div>
                          <div class="w-100 pt-4 pb-5">
                              <div class="spark-chart" data-toggle="spark-chart" data-color="warning" data-dataset="[47, 94, 24, 18, 26, 65, 31, 47, 10, 44, 45]"></div>
                          </div>
                          <div class="progress-wrapper mb-3">
                              <small class="progress-label">Concept</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                              </div>
                          </div>
                          <div class="progress-wrapper">
                              <small class="progress-label">Prototyping</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                              </div>
                          </div>
                          <div class="progress-wrapper">
                              <small class="progress-label">Testing</small>
                              <div class="progress mt-0" style="height: 3px;">
                                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6">
                  <!-- Project overview -->
                  <div class="card card-fluid">
                      <div class="card-header">
                          <h6 class="mb-0">Project overview</h6>
                      </div>
                      <div class="card-body py-3 flex-grow-1">
                          <!-- Progress -->
                          <div class="pb-3 mb-3 border-bottom">
                              <div class="row align-items-center">
                                  <div class="col-auto">
                                      <!-- Avatar -->
                                      <img alt="Image placeholder" v-if="project.logo" :src="project.logo" class="avatar rounded-circle">
                                      <img alt="Image placeholder" v-else src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/theme/light/brand-avatar-1.png" class="avatar rounded-circle">
                                  </div>

                                  <div class="col ml-n2">
                                      <div class="progress-wrapper">
                                          <span class="progress-percentage"><small class="font-weight-bold">Completed: </small>{{ totalDonePercentage }}%</span>
                                          <div class="progress progress-xs mt-2">
                                              <div class="progress-bar bg-success" role="progressbar" :aria-valuenow="totalDonePercentage" aria-valuemin="0" aria-valuemax="100" :style="'width: '+totalDonePercentage+'%;'"></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- Description -->
<!--                          <span class="text-sm mb-0" v-html="project.description">-->
<!--                          </span>-->
                          <read-more more-str="read more" :text="project.description" link="#" less-str="read less" :max-chars="120"></read-more>
                      </div>
                      <div class="card-footer py-0">
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item px-0">
                                  <div class="row align-items-center">
                                      <div class="col-6">
                                          <span class="form-control-label">Private project:</span>
                                      </div>
                                      <div class="col-6 text-right">
                                          <span class="badge badge-success badge-pill" v-if="project.privacy === 'private'">Yes</span>
                                          <span class="badge badge-danger badge-pill" v-else>No</span>
                                      </div>
                                  </div>
                              </li>
                              <li class="list-group-item px-0">
                                  <div class="row align-items-center">
                                      <div class="col-6">
                                          <small>Start date:</small>
                                          <div class="h6 mb-0">{{ project.starting_date }}</div>
                                      </div>
                                      <div class="col-6">
                                          <small>End date:</small>
                                          <div class="h6 mb-0">{{ project.deadline }}</div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h6 class="mb-0">Starting</h6>
                              </div>
                              <div class="text-right">
<!--                                  <button-->
<!--                                      class="btn btn-sm btn-success btn-icon-only rounded-circle ml-4">-->
<!--                                        <span class="btn-inner&#45;&#45;icon">-->
<!--                                          <i class="fas fa-plus"></i>-->
<!--                                        </span>-->
<!--                                  </button>-->
                                  <div class="actions">
                                      <a href="#" class="action-item" @click.prevent="refreshTodos"><i class="fas fa-sync"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-wrapper p-3">
                          <div class="checklist" data-toggle="dragula">
                              <div class="card border draggable-item shadow-none"  v-for="(todo, index) in project.todos" :key="index" v-if="todo.category === 'starting'">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-10">
                                          <span v-if="todo.status === 'done'">
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' checked @click="undoTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                          <span v-else>
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' @click="doTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                      </div>
                                      <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" @click.prevent="editTodoButton(todo)" class="dropdown-item">Edit</a>
                                                  <a href="#" @click.prevent="deleteTodo(todo.id)" class="dropdown-item">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="card border shadow-none">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-12">
                                          <div class="custom-control">
                                              <div class="d-flex">
                                                  <!--                                                  <i class="fas fa-ellipsis-v mt-3 mr-2"></i>-->
                                                  <input type="text" class="form-control p-2 text-center border-warning" v-model="todoFormStart.todo" placeholder="Add new todo here" @keyup.enter.prevent="addNewTodoStart">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h6 class="mb-0">Intermediate</h6>
                              </div>
                              <div class="text-right">
<!--                                  <button-->
<!--                                      class="btn btn-sm btn-success btn-icon-only rounded-circle ml-4">-->
<!--                                        <span class="btn-inner&#45;&#45;icon">-->
<!--                                          <i class="fas fa-plus"></i>-->
<!--                                        </span>-->
<!--                                  </button>-->
                                  <div class="actions">
                                      <a href="#" class="action-item" @click.prevent="refreshTodos"><i class="fas fa-sync"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-wrapper p-3">
                          <div class="checklist" data-toggle="dragula">
                              <div class="card border draggable-item shadow-none"  v-for="(todo, index) in project.todos" :key="index" v-if="todo.category === 'intermediate'">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-10">
                                          <span v-if="todo.status === 'done'">
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' checked @click="undoTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                          <span v-else>
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' @click="doTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                      </div>
                                      <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" @click.prevent="editTodoButton(todo)" class="dropdown-item">Edit</a>
                                                  <a href="#" @click.prevent="deleteTodo(todo.id)" class="dropdown-item">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="card border shadow-none">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-12">
                                          <div class="custom-control">
                                              <div class="d-flex">
                                                  <!--                                                  <i class="fas fa-ellipsis-v mt-3 mr-2"></i>-->
                                                  <input type="text" class="form-control p-2 text-center border-primary" v-model="todoFormIntermediate.todo" placeholder="Add new todo here" @keyup.enter.prevent="addNewTodoIntermediate">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-sm-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h6 class="mb-0">Finalizing</h6>
                              </div>
                              <div class="text-right">
<!--                                  <button-->
<!--                                      class="btn btn-sm btn-success btn-icon-only rounded-circle ml-4">-->
<!--                                        <span class="btn-inner&#45;&#45;icon">-->
<!--                                          <i class="fas fa-plus"></i>-->
<!--                                        </span>-->
<!--                                  </button>-->
                                  <div class="actions">
                                      <a href="#" class="action-item" @click.prevent="refreshTodos"><i class="fas fa-sync"></i></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-wrapper p-3">
                          <div class="checklist" data-toggle="dragula">
                              <div class="card border draggable-item shadow-none" v-for="(todo, index) in project.todos" :key="index" v-if="todo.category === 'finalizing'">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-10">
                                          <span v-if="todo.status === 'done'">
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' checked @click="undoTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                          <span v-else>
                                            <div class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" :id='todo.id' @click="doTodo(todo)">
                                                 <label class="custom-control-label h6 text-sm" :for='todo.id'>{{ todo.todo }}</label>
                                            </div>
                                          </span>
                                      </div>
                                      <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" @click.prevent="editTodoButton(todo)" class="dropdown-item">Edit</a>
                                                  <a href="#" @click.prevent="deleteTodo(todo.id)" class="dropdown-item">Delete</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="card border shadow-none">
                                  <div class="px-3 py-2 row align-items-center">
                                      <div class="col-12">
                                          <div class="custom-control">
                                              <div class="d-flex">
                                                  <!--                                                  <i class="fas fa-ellipsis-v mt-3 mr-2"></i>-->
                                                  <input type="text" class="form-control p-2 text-center border-success" v-model="todoFormFinalizing.todo" placeholder="Add new todo here" @keyup.enter.prevent="addNewTodoFinalizing">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Project details -->
          <div class="row">
              <div class="col-xl-12">
                  <div class="card">
                      <div class="card-header border-0">
                          <div class="row align-items-center">
                              <div class="col">
                                  <h6 class="mb-0">User performance</h6>
                              </div>
                              <div class="col-auto">
                                  <div class="actions">
                                      <a href="#!" class="action-item">
                                          <i class="fas fa-file-export"></i>
                                          <span class="d-none d-sm-inline-block mr-4">Export</span>
                                      </a>
                                      <a href="#!" class="action-item">
                                          <i class="fas fa-print"></i>
                                          <span class="d-none d-sm-inline-block">Print</span>
                                      </a>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="table-responsive">
                          <table class="table align-items-center">
                              <thead>
                              <tr>
                                  <th scope="col" class="sort" data-sort="name">Name</th>
                                  <th scope="col" class="sort" data-sort="groups">Groups</th>
                                  <th scope="col" class="sort" data-sort="tasks">Tasks</th>
                                  <th scope="col">Completion</th>
                                  <th scope="col"></th>
                              </tr>
                              </thead>
                              <tbody class="list">
                              <tr v-for='(dev, index) in project.devs' :key="index">
                                  <th scope="row">
                                      <div class="media align-items-center">
                                          <div>
                                              <img alt="Image placeholder" v-if="dev.dev_image" :src="dev.dev_image" class="avatar  rounded-circle avatar-sm">
                                              <img alt="Image placeholder" v-else :src="dev.dev_image" class="avatar  rounded-circle avatar-sm">
                                          </div>
                                          <div class="media-body ml-3">
                                              <router-link :to="'/dashboard/user/'+ dev.dev_username" class="name mb-0 h6 text-sm">{{ dev.dev_name }}</router-link>
                                          </div>
                                      </div>
                                  </th>
                                  <td>
                                      <a href="#" class="badge badge-secondary" v-show="dev.dev_type === 'FEnd'">Front End</a>
                                      <a href="#" class="badge badge-secondary" v-show="dev.dev_type === 'BEnd'">Back End</a>
                                      <a href="#" class="badge badge-secondary" v-show="dev.dev_type === 'fullStack'">Full Stack</a>
                                  </td>
                                  <td class="budget">
                                      <span @change.prevent="changePercentage(dev.tasks, totalTodos)">{{ dev.tasks }}</span>
                                  </td>
                                  <td>
                                      <div class="d-flex align-items-center">
                                          <span class="completion mr-2">{{((dev.tasks/totalTodos)*100).toFixed(0) }}%</span>
                                          <div>
                                              <div class="progress" style="width: 100px;">
                                                  <div class="progress-bar bg-success" role="progressbar" :aria-valuenow="(dev.tasks/totalTodos)*100" aria-valuemin="0" aria-valuemax="100" :style="'width: ' + (dev.tasks/totalTodos)*100 + '%;'">

                                                  </div>
                                              </div>
                                          </div>
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
                                              <button class="dropdown-item" @click.prevent="removeDev(dev.id)">Remove from project</button>
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
          <div class="row">
              <div class="col-sm-6">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h6 class="mb-0">Attachments</h6>
                              </div>
                              <div class="text-right">
                                  <div class="actions">
                                      <a href="#" class="action-item"><i class="fas fa-sync"></i></a>
                                      <div class="dropdown action-item" data-toggle="dropdown">
                                          <a href="#" class="action-item"><i class="fas fa-ellipsis-h"></i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                              <a href="#" class="dropdown-item">Refresh</a>
                                              <a href="#" class="dropdown-item">Manage Widgets</a>
                                              <a href="#" class="dropdown-item">Settings</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card-wrapper p-3">
                          <!-- Files -->
                          <div class="card mb-3 border shadow-none">
                              <div class="px-3 py-3">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/files/pdf.png" class="img-fluid" style="width: 40px;">
                                      </div>
                                      <div class="col ml-n2">
                                          <h6 class="text-sm mb-0">
                                              <a href="#!">design-principles.pdf</a>
                                          </h6>
                                          <p class="card-text small text-muted">
                                              189 KB
                                          </p>
                                      </div>
                                      <div class="col-auto actions">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" class="dropdown-item">Refresh</a>
                                                  <a href="#" class="dropdown-item">Manage Widgets</a>
                                                  <a href="#" class="dropdown-item">Settings</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card mb-3 border shadow-none">
                              <div class="px-3 py-3">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/files/psd.png" class="img-fluid" style="width: 40px;">
                                      </div>
                                      <div class="col ml-n2">
                                          <h6 class="text-sm mb-0">
                                              <a href="#!">website-wireframe.psd</a>
                                          </h6>
                                          <p class="card-text small text-muted">
                                              45.9 MB
                                          </p>
                                      </div>
                                      <div class="col-auto actions">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" class="dropdown-item">Refresh</a>
                                                  <a href="#" class="dropdown-item">Manage Widgets</a>
                                                  <a href="#" class="dropdown-item">Settings</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card mb-3 border shadow-none">
                              <div class="px-3 py-3">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/files/doc.png" class="img-fluid" style="width: 40px;">
                                      </div>
                                      <div class="col ml-n2">
                                          <h6 class="text-sm mb-0">
                                              <a href="#!">product-guidelines.doc</a>
                                          </h6>
                                          <p class="card-text small text-muted">
                                              87 KB
                                          </p>
                                      </div>
                                      <div class="col-auto actions">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" class="dropdown-item">Refresh</a>
                                                  <a href="#" class="dropdown-item">Manage Widgets</a>
                                                  <a href="#" class="dropdown-item">Settings</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card mb-3 border shadow-none">
                              <div class="px-3 py-3">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/files/avi.png" class="img-fluid" style="width: 40px;">
                                      </div>
                                      <div class="col ml-n2">
                                          <h6 class="text-sm mb-0">
                                              <a href="#!">banner-video.avi</a>
                                          </h6>
                                          <p class="card-text small text-muted">
                                              23 MB
                                          </p>
                                      </div>
                                      <div class="col-auto actions">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" class="dropdown-item">Refresh</a>
                                                  <a href="#" class="dropdown-item">Manage Widgets</a>
                                                  <a href="#" class="dropdown-item">Settings</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card mb-3 border shadow-none">
                              <div class="px-3 py-3">
                                  <div class="row align-items-center">
                                      <div class="col-auto">
                                          <img alt="Image placeholder" src="https://demo.webpixels.io/purpose-application-ui-kit-v1.0.0/assets/img/icons/files/png.png" class="img-fluid" style="width: 40px;">
                                      </div>
                                      <div class="col ml-n2">
                                          <h6 class="text-sm mb-0">
                                              <a href="#!">logo.png</a>
                                          </h6>
                                          <p class="card-text small text-muted">
                                              189 kb
                                          </p>
                                      </div>
                                      <div class="col-auto actions">
                                          <div class="dropdown" data-toggle="dropdown">
                                              <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-h"></i>
                                              </a>
                                              <div class="dropdown-menu dropdown-menu-right">
                                                  <a href="#" class="dropdown-item">Refresh</a>
                                                  <a href="#" class="dropdown-item">Manage Widgets</a>
                                                  <a href="#" class="dropdown-item">Settings</a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="card card-fluid">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                  <h6 class="mb-0">Latest comments</h6>
                              </div>
                              <div class="text-right">
                                  <div class="actions">
                                      <a href="#" class="action-item"><i class="fas fa-sync"></i></a>
                                      <div class="dropdown action-item" data-toggle="dropdown">
                                          <a href="#" class="action-item"><i class="fas fa-ellipsis-h"></i></a>
                                          <div class="dropdown-menu dropdown-menu-right">
                                              <a href="#" class="dropdown-item">Refresh</a>
                                              <a href="#" class="dropdown-item">Manage Widgets</a>
                                              <a href="#" class="dropdown-item">Settings</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="list-group list-group-flush">
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                  <div>
                                      <span class="avatar bg-primary text-white rounded-circle">AM</span>
                                  </div>
                                  <div class="flex-fill ml-3">
                                      <div class="h6 text-sm mb-0">Alex Michael <small class="float-right text-muted">2 hrs ago</small></div>
                                      <p class="text-sm lh-140 mb-0">
                                          Some quick example text to build on the card title.
                                      </p>
                                  </div>
                              </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                  <div>
                                      <span class="avatar bg-warning text-white rounded-circle">SW</span>
                                  </div>
                                  <div class="flex-fill ml-3">
                                      <div class="h6 text-sm mb-0">Sandra Wayne <small class="float-right text-muted">3 hrs ago</small></div>
                                      <p class="text-sm lh-140 mb-0">
                                          Some quick example text to build on the card title.
                                      </p>
                                  </div>
                              </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="5 hrs ago">
                                  <div>
                                      <span class="avatar bg-info text-white rounded-circle">JM</span>
                                  </div>
                                  <div class="flex-fill ml-3">
                                      <div class="h6 text-sm mb-0">Jason Miller <small class="float-right text-muted">5 hrs ago</small></div>
                                      <p class="text-sm lh-140 mb-0">
                                          Some quick example text to build on the card title.
                                      </p>
                                  </div>
                              </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago">
                                  <div>
                                      <span class="avatar bg-dark text-white rounded-circle">MJ</span>
                                  </div>
                                  <div class="flex-fill ml-3">
                                      <div class="h6 text-sm mb-0">Mike Thomson <small class="float-right text-muted">2 hrs ago</small></div>
                                      <p class="text-sm lh-140 mb-0">
                                          Some quick example text to build on the card title.
                                      </p>
                                  </div>
                              </div>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="3 hrs ago">
                                  <div>
                                      <span class="avatar bg-primary text-white rounded-circle">RN</span>
                                  </div>
                                  <div class="flex-fill ml-3">
                                      <div class="h6 text-sm mb-0">Richard Nixon <small class="float-right text-muted">3 hrs ago</small></div>
                                      <p class="text-sm lh-140 mb-0">
                                          Some quick example text to build on the card title.
                                      </p>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="card-footer py-2 text-center">
                          <a href="#" class="text-sm text-muted font-weight-bold">See all notifications</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>
<script>
    import FlipCountdown from 'vue2-flip-countdown'
    export default {
        props: [
          'slag'
      ],
        components:{
            FlipCountdown,
        },
        data() {
            return {
                projectData: {},
                developerType: '',
                users: {},
                todos: {},

                todoFormStart : new Form({
                    'project_slag' : this.slag,
                    'todo' : '',
                    'category' : 'starting'
                }),

                todoFormIntermediate : new Form({
                    'project_slag' : this.slag,
                    'todo' : '',
                    'category' : 'intermediate'
                }),

                todoFormFinalizing : new Form({
                    'project_slag' : this.slag,
                    'todo' : '',
                    'category' : 'finalizing'
                }),

                todoForm : new Form({
                    'id' :'',
                    'todo' : '',
                }),
            };
      },
        methods: {
          getUsers(){
              axios.get('/api/users')
                  .then(({data}) => {
                      this.users = data
                  })
          },
          getProject(){
            axios.get('/api/projects/' + this.slag)
              .then(({data}) => {
                  this.projectData = data
              })
          },

          getTodos(){
              axios.get('/api/todo')
              .then(({data}) => {
                  this.todos = data
              })
          },

          refreshTodos(){
              Fire.$emit("refreshTodo");
          },

          addNewTodoStart(){
                this.todoFormStart.post('/api/todo')
              .then(() => {
                  this.todoFormStart.reset();
                  Fire.$emit("refreshTodo");
                  Toast.fire({
                      icon: "success",
                      title: "Todo created successfully!"
                  });
              })
              .catch( error => {
                  console.log(error);
              })
          },

          addNewTodoIntermediate(){
                this.todoFormIntermediate.post('/api/todo')
              .then(() => {
                  this.todoFormIntermediate.reset();
                  Fire.$emit("refreshTodo");
                  Toast.fire({
                      icon: "success",
                      title: "Todo created successfully!"
                  });
              })
              .catch( error => {
                  console.log(error);
              })
          },

          addNewTodoFinalizing(){
                this.todoFormFinalizing.post('/api/todo')
              .then(() => {
                  this.todoFormFinalizing.reset();
                  Fire.$emit("refreshTodo");
                  Toast.fire({
                      icon: "success",
                      title: "Todo created successfully!"
                  });
              })
              .catch( error => {
                  console.log(error);
              })
          },

          undoTodo(todo){
              let data = {
                  'slag' : this.slag
              };
              axios.put('/api/undotodo/' + todo.id, data)
              .then(() => {
                  Fire.$emit('refreshTodo');
                  console.log('make undo todo');
              })
          },

          doTodo(todo){
              let data = {
                  'slag' : this.slag
              };
              axios.put('/api/dotodo/' + todo.id, data)
              .then(() => {
                  Fire.$emit('refreshTodo');
                  console.log('make do todo');
              })
          },

          editTodoButton(todo){
              this.todoForm.reset();
              $('#modal-edit-todo').modal('show');
              this.todoForm.fill(todo);
          },

          updateTodo(){
              this.todoForm
                  .put("/api/todo/" + this.todoForm.id)
                  .then(() => {
                      Fire.$emit("refreshTodo");
                      $("#modal-edit-todo").modal("hide");
                      Swal.fire("Updated!", "Update has been successful!.", "success");
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

          deleteTodo(id) {
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
                      this.todoForm
                          .delete("/api/todo/" + id)
                          .then(() => {
                              Fire.$emit("refreshTodo");
                              Swal.fire("Deleted!", "Your todo has been deleted.", "success");
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
                      Fire.$emit("refreshTodo");
                      Console.log("Cancel button clicked");
                  }
              });
          },

          addDevToProject(user){
              let devApply = {};
              devApply = {
                  'id' : user.id,
                  'username' : user.username,
                  'name' : user.name,
                  'email' : user.email,
                  'devType' : user.devType,
                  'image' : user.image,
                  'group' : 'Full Stack',
                  'project_slag' : this.slag

               };

               axios.post('/api/devdept', devApply)
                   .then(() => {
                       Fire.$emit("refreshTodo");
                       $('#modal-users').modal('hide');
                       Toast.fire({
                           icon: "success",
                           title: "Developer added successfully!"
                       });
                   })
                   .catch( error => {
                       console.log(error);
                   });

          },

            removeDev(id){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, remove from here!"
                }).then(result => {
                    if (result.value) {
                        axios.delete('/api/devdept/' + id)
                            .then(() => {
                                Fire.$emit("refreshTodo");
                                Swal.fire("Deleted!", "Developer has been removed.", "success");
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
                        Fire.$emit("refreshTodo");
                        Console.log("Cancel button clicked");
                    }
                });
            },

            changePercentage(tasks, totalTasks){

            }


      },
        computed:{
            totalTodos(){
                return (this.todos).length;
            },

            totalTodosDone(){
                return _.filter(this.todos, {'status': 'done'}).length;
            },

            totalDonePercentage(){
                let $total = (this.todos).length;
                let $done =  _.filter(this.todos, {'status': 'done'}).length;

                return (($done/$total)*100).toFixed(2);
            },

            startingDonePerentage(){
               let $total = _.filter(this.todos, ["category", "starting"]).length;
               let $done =  _.filter(this.todos, {"category": "starting", 'status': 'done'}).length;

                return ($done/$total)*100;
            },

            intermediateDonePerentage(){
               let $total = _.filter(this.todos, ["category", "intermediate"]).length;
               let $done =  _.filter(this.todos, {"category": "intermediate", 'status': 'done'}).length;

                return ($done/$total)*100;
            },

            finalizingDonePerentage(){
               let $total = _.filter(this.todos, ["category", "finalizing"]).length;
               let $done =  _.filter(this.todos, {"category": "finalizing", 'status': 'done'}).length;

                return ($done/$total)*100;
            },
        },
        created() {
        this.getUsers();
        this.getProject();
        this.getTodos();
          Fire.$on('refreshTodo', () => {
              this.getProject();
              this.getTodos();
          });
      }
    };
</script>
<style lang="scss" scoped>
.change-select {
  font-size: .8rem;
  font-weight: bold;
}
</style>
