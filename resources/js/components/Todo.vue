<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <AddTodo v-on:add-todo="addtodo"/>
                <EditTodo v-on:edit-todo="updateTodo" v-if="edit == true" v-bind:todo="singletodo" />
                <div class="card mt-5">
                    <div class="card-header">Todo Component</div>
                    
                    <div class="card-body">
                      <div class="search"><input type="text" @keyup="searchTodo" v-model="search"><i class="fas fa-search"></i>
                      </div>
                        <ul class="list-gro">
                          <li class="list-group-item show-todo"  v-for="list in lists" v-bind:key="list.id">{{list.name}} 
                          <div>
                            <i class="fas fa-pen mr-2" @click="editTodo(list.id)"></i>
                            <i class="fas fa-trash" @click="deleteTodo(list.id)"></i>
                          </div>
                          </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AddTodo from './AddTodo.vue'
import EditTodo from './EditTodo.vue'
    export default {
        components: {
          AddTodo,
          EditTodo
        },
        data(){
          return{
            lists: [],
            edit: false,
            singletodo: '',
            search: ''
          }
        },
        methods: {
          searchTodo(){
            if(this.search.length > 1){
              let key = this.search
              axios.get(`http://127.0.0.1:8000/todos/${key}`)
              .then(res => {
                this.lists = res.data
              })
              .catch(err => console.log(err))
            }else{
              this.getTodo()
            }
          },
          addtodo(namee){
            axios.post('http://127.0.0.1:8000/todos', {
              name: namee,
            })
              .then(() => {
                this.getTodo()
              })
              .catch(err => console.log(err))
          },

          editTodo(id){
            this.edit = true
            axios.get(`http://127.0.0.1:8000/todos/edit/${id}`)
              .then((res => this.singletodo = res.data))
              .catch(err => console.log(err))
          },

          updateTodo(data){
            axios.post(`http://127.0.0.1:8000/todos/update/${this.singletodo.id}`, {
              name: data.name,
              _method: 'put'})
                .then(() => {
                  console.log(`${data.name} is updated`)
                  this.edit = false
                  this.getTodo()
                })
          },

          deleteTodo(id){
            console.log(id)
            axios.post(`http://127.0.0.1:8000/todos/delete/${id}`, {_method: 'delete'})
              .then(() => {
                console.log(`${id} delete Success fully`)
                this.getTodo()
                })
              .catch(err => console.log(err))
          },

          getTodo(){
            axios.get('http://127.0.0.1:8000/todos')
              .then(res => this.lists = res.data)
              .catch(err => console.log(err))
          }
        },
        mounted(){
          this.getTodo()
        }
    }
</script>


<style scoped>
.show-todo{
  display: flex;
  justify-content: space-between;
}

i{
  background: #000;
  color: #fff;
  padding: 5px;
  cursor: pointer;
}
</style>