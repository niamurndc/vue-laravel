<template>
    <div class="card mt-5">
        <div class="card-header">Add New Todo</div>

        <div class="card-body">
            <form @submit.prevent="edittodo">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" v-model="todo.name" class="form-control">
              </div>
              <input type="submit" value="Add Todo">
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['todo'],
        data(){
          return{
            data: {
            }
          }
        },

        methods: {
            edittodo(){
            console.log(this.todo.name);
            this.$emit('edit-todo', this.todo)
            this.todo.name = ''
          }
        },
        mounted(){
          console.log('mounted');
        }
    }
</script>