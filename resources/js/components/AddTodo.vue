<template>
    <div class="card mt-5">
        <div class="card-header"><h4>Add New Todo</h4></div>

        <div class="card-body">
            <form @submit.prevent="addtodo">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" v-model="name" class="form-control">
              </div>
              <input type="submit" value="Add Todo">
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
            name: ''
          }
        },

        methods: {
          addtodo(){
            this.$emit('add-todo', this.name)
            this.name = ''
          }
        }
    }
</script>