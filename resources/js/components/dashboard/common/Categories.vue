<template>
    <div class="categories__wrapper" v-if="showModal">
        <!-- Category Modal -->
        <div class="modal fade" id="modal" tabindex="-2" role="dialog" aria-hidden="true">
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
                                    <div class="card-header bg-primary font-weight-bold text-light" v-show="!editCat">
                                        Add new category
                                    </div>
                                    <div class="card-header bg-danger font-weight-bold text-light" v-show="editCat">
                                        Edit category
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Name of category" v-model="categoryForm.name" :class="{ 'is-invalid': categoryForm.errors.has('name') }">
                                            <has-error class="text-danger" :form="categoryForm" field="name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="custom-select bg-light" v-model="categoryForm.status" :class="{ 'is-invalid': categoryForm.errors.has('status')}">
                                                <option value="">Select a type</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            <has-error class="text-danger" :form="categoryForm" field="status"></has-error>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill mr-auto" v-show="!editCat" @click.prevent="addCategory">Publish</button>
                                        <button type="button" class="btn btn-sm btn-danger rounded-pill mr-auto" v-show="editCat" @click.prevent="updateCategory">Update</button>
                                        <button type="button" class="btn btn-sm btn-info rounded-pill ml-auto" v-show="editCat" @click.prevent="cancelUpdate">Cancel</button>
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
                                            <th class="text-capitalize">
                                                {{ category.name }}
                                            </th>
                                            <td>
                                                {{ category.name }}
                                            </td>
                                            <td>
                                                <span class="badge badge-dot mr-4">
                                                    <span v-if="category.status === 'inactive'">
                                                        <i class="bg-warning"></i>
                                                    </span>

                                                    <span v-else >
                                                        <i class="bg-success"></i>
                                                    </span>
                                                    <span class="status">{{ category.status }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                {{ category.author.name }}
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown" data-toggle="dropdown">
                                                    <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item" @click.prevent="editCategory(category)">Edit</button>
                                                        <button class="dropdown-item" @click.prevent="deleteCategory(category.id)">Delete</button>
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
                        <button type="button" class="btn btn-sm btn-info rounded-pill" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                showModal: false,
                editCat: false,
                categories: {},
                categoryForm : new Form({
                    'id' : '',
                    'name' : '',
                    'status' : ''
                }),
            }
        },

        methods:{
            getCategories(){
                axios.get('/api/category')
                    .then(({data}) => {
                        this.categories = data
                    })
            },

            categoryButton(){
                this.showModal = true;
                this.editCat = false;
                Fire.$emit('loadCategoryModal');
                $('#category-modal').modal('show');
            },

            //Categories
            categoryButton(){
                this.editCat = false;
                $('#category-modal').modal('show');
            },
            addCategory(){
                this.editCat =  false;
                this.categoryForm.post('/api/category')
                    .then(() => {
                        this.categoryForm.reset();
                        Toast.fire({
                            icon: 'success',
                            title: 'Category created successfully!'
                        });
                        Fire.$emit('loadCategoryModal');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            editCategory(category){
                this.editCat =  true;
                this.categoryForm.reset();
                this.categoryForm.fill(category);
            },
            updateCategory(){
                this.categoryForm.put('/api/category/'+ this.categoryForm.id)
                    .then(()=> {
                        Swal.fire(
                            'Updated!',
                            'Update has been successful!.',
                            'success'
                        );
                        this.editCat = false;
                        this.categoryForm.reset();
                        Fire.$emit('loadCategoryModal');
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: ''
                        })
                    })
            },
            cancelUpdate(){
                this.categoryForm.reset();
                this.editCat = false;
            },
            deleteCategory(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.categoryForm.delete('/api/category/' + id)
                            .then(() => {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                Fire.$emit('loadCategoryModal');
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: ''
                                })
                            })
                    }else{
                        Fire.$emit('loadCategoryModal');
                        Console.log('Cancel button clicked');
                    }
                })
            },
        },
        created(){
            this.getCategories();

            Fire.$on('loadCategoryModal', () => {
                this.getCategories();
            })
        }
    }
</script>
