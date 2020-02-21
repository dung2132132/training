<template>
<div class="">
  <h1>Create Student</h1>
  <form>
    <div class="form-group">
      <label for="">Stundent Code <span  style="color: red">*</span></label>
      <input :class="{'is-invalid': checkError(errors.code)}" type="text" class="form-control" aria-describedby="emailHelp" v-model="students.code">
      <span v-if="errors.code.length >0" style="color: red">{{errors.code}}</span>
    </div>
    <div class="form-group">
      <label for="">Name <span  style="color: red">*</span></label>
      <input :class="{'is-invalid': checkError(errors.name)}" type="text" class="form-control"  v-model="students.name">
      <span v-if="errors.name.length>0" style="color: red">{{errors.name}}</span>
    </div>
    <div class="form-group">
      <label for="">Age <span  style="color: red">*</span></label>
      <input :class="{'is-invalid': checkError(errors.age)}" type="number" class="form-control" v-model="students.age">
      <span v-if="errors.age" style="color: red">{{errors.age}}</span>
    </div>
    <div class="form-group">
      <label for="">Gender <span  style="color: red">*</span></label>
      <select name="" id="" class="form-control" v-model="students.gender" :class="{'is-invalid': checkError(errors.gender)}">
        <option value="">--Select--</option>
        <option value="1">Nam</option>
        <option value="0">Nữ</option>
      </select>
      <span v-if="errors.gender" style="color: red">{{errors.gender}}</span>
    </div>
    <div class="form-group">
      <label for="">Email <span  style="color: red">*</span></label>
      <input :class="{'is-invalid': checkError(errors.email)}" type="email" class="form-control"  v-model="students.email">
      <span v-if="errors.email.length>0" style="color: red">{{errors.email}}</span>
    </div>
    <div class="form-group">
      <label for="">Address <span  style="color: red">*</span></label>
      <input :class="{'is-invalid': checkError(errors.address)}" type="text" class="form-control" v-model="students.address">
      <span v-if="errors.code" style="color: red">{{errors.address}}</span>
    </div>
      <NLink :to="{name:'student'}">
        <button type="button" class="btn btn-outline-primary">
          <i class="fa fa-angle-left" aria-hidden="true"></i>Back
        </button>
      </NLink>
    <button type="button" class="btn btn-primary" @click="addStudent">
      <i class="fa fa-floppy-o" aria-hidden="true"></i>Save
    </button>
  </form>
</div>
</template>

<script>
  export default {
    props: {
      students: {
        type: Object,
        require: false,
        default:() => {
          return {
            id: 0,
            code: '',
            name: '',
            age: '',
            gender: '',
            email: '',
            address: '',
          }
        }
      }
    },
    data() {
      return {
        errors: {
          code: '',
          name: '',
          age: '',
          gender: '',
          email: '',
          address: '',
        },
        isError: false
      }
    },
    methods: {
      checkError(message){
        return message.length
      },
      async addStudent() {
        Object.keys(this.errors).forEach(key => {
          this.$set(this.errors, key, '')
        })
        if (this.students.code.length == 0) {
          this.errors.code = 'The code field is required.'
        } else if (this.students.code.indexOf(' ') !== -1) {
          this.errors.code = 'Student code must not contain spaces.'
        }
        else if(this.students.code.length>=255){
          this.errors.code = 'The code field is max=255.'
        }

        //check student name
        if (this.students.name.length == 0) {
          this.errors.name = 'The name field is required.'
        }

        //check age
        if (!this.students.age) {
          this.errors.age = 'The age field is required.'
        } else if (isNaN(this.students.age)) {
          this.errors.age = 'The age must be an integer.'
        } else {
          let age = parseInt(this.students.age);
          if (age == 0) {
            this.errors.age = 'The gender field is required.'
          } else if (age < 18) {
            this.errors.age = 'The age must be at least 18.'
          } else if (age > 35) {
            this.errors.age = 'The age may not be greater than 35.'
          }
        }

        //check gender
        if (!this.students.gender) {
          this.errors.gender = 'The gender field is required.'
        }

        //check email
        if (!this.students.email) {
          this.errors.email = 'The email field is required.'
        } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.students.email) == false) {
          this.errors.email = 'The email must be a valid email address.'
        }

        //check address
        if (!this.students.address) {
          this.errors.address = 'The address field is required.'
        }
        this.isError = false
        Object.keys(this.errors).forEach(key => {
          if (this.errors[key].length > 0) {
            this.isError = true;
          }
        })
        console.log(this.isError);
        if (this.isError) {
          return
        }

        await this.$axios.$post('api/student', this.students)
        this.$router.push({name: 'student'})
      },
    }
  }
</script>

<style scoped>

</style>
