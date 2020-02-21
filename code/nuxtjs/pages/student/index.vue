<template>
    <div>
      <h1>Student list</h1>
      <NLink :to="{name:'index'}"><button class="btn btn-outline-primary"><i class="fa fa-home"></i>Home Page</button></NLink>
      <NLink :to="{name:'student-add_student'}"><button class="btn btn-outline-primary"><i class="fa fa-plus" aria-hidden="true"></i>Add new student</button></NLink>
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Code</th>
          <th scope="col">Name</th>
          <th scope="col">Age</th>
          <th scope="col">Gender</th>
          <th scope="col">Email</th>
          <th scope="col">Address</th>
          <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in students">
          <th scope="row">{{index+1}}</th>
          <td>{{item.code}}</td>
          <td>{{item.name}}</td>
          <td>{{item.age}}</td>
          <td>
            <i v-if="item.gender==1" class="fa fa-mars" aria-hidden="true"></i>
            <i v-if="item.gender==0" class="fa fa-venus" aria-hidden="true"></i>
          </td>
          <td>{{item.email}}</td>
          <td>{{item.address}}</td>
          <td>
            <NLink :to="{name:'student-edit-id',params:{id:item.id}}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: blue"></i></NLink>
            <a @click="delete_student(item.id)"><i class="fa fa-trash-o" aria-hidden="true" style="color: red"></i></a>
          </td>
        </tr>
        </tbody>
      </table>
      <div class="text-center">
        <div class="pr-3 d-inline">
          Page: <strong>{{currentPage}}</strong>/{{totalPage}}
        </div>
        <button
          :class="{'disabled': currentPage <= 1}"
          class="btn btn-outline-info mr-3"
          @click="prevPage"
        >
          Prev
        </button>
        <button
          :class="{'disabled': currentPage >= totalPage}"
          class="btn btn-outline-info"
          @click="nextPage"
        >
          Next
        </button>
      </div>
    </div>
</template>

<script>
    export default {
      data() {
        return {
          students: [],
          currentPage:1,
          totalPage:1,
          perPage: 10,
          tmpPage: 1,
        }
      },
      async asyncData({$axios,route}) {
        // console.log(this.currentPage)
        let page = route.query.page == undefined ? 1 : route.query.page
        const data = await $axios.$get(`api/student?page=${page}`)
        return {
          students: data.data,
          currentPage: data.current_page,
          tmpPage: data.current_page,
          totalPage: data.last_page,
          perPage: data.per_page
        }
      },
      methods: {
        async loadData(page) {
          const data = await this.$axios.$get(`api/student?page=${page}`)
          this.students = data.data
          if (this.students.length == 0) {
            return this.$router.push({name: 'student'})
          }
          this.currentPage = data.current_page
          this.tmpPage = data.current_page
          this.totalPage = data.last_page
          this.perPage = data.per_page
          return this.$router.push({name: 'student',query: {page: this.tmpPage}})
        },
        nextPage() {
          if (this.currentPage >= this.totalPage) {
            return;
          }
          this.tmpPage++;
          this.loadData(this.tmpPage);
        },
        prevPage() {
          if (this.currentPage <= 1) {
            return;
          }
          this.tmpPage--;
          this.loadData(this.tmpPage);
        },
        delete_student(id) {
          this.$bvModal.msgBoxConfirm('Are you sure?')
            .then(value => {
              if (value) {
                this.Delete_student(id)
              }
            })
            .catch(err => {
            })
        },
        async Delete_student(id) {
          await this.$axios.$delete(`api/student/${id}`).then(response => {
            location.reload()
          }).catch(error => {
          })
        },
      }
    }
</script>
