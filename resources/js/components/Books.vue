<template>
  <div>
    <h2>My Books</h2>
    <form @submit.prevent="addBook" class="mb-1">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="book.title">
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button @click="clearForm()" class="btn btn-danger">Reset</button>
    </form>

    <div class="row">
        <div class="col-md-8">
            <div class="card-header">Book List</div>
            <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Book Name</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="book_list_table">
                <tr v-for="(book, key) in books" v-bind:key="book.id">
                    <th scope="row">{{++key}}</th>
                    <td>{{book.title}}</td>
                    <td>
                        <button type="button" class="btn btn-success" @click="editBook(book)">Edit</button>
                        <button type="button" class="btn btn-danger" @click="deleteBook(book.id,'soft')">Soft Delete</button>
                        <button type="button" class="btn btn-warning" @click="deleteBook(book.id,'hard')">Hard Delete</button>

                    </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
  </div>
</template>

<script>
export default {
     mounted() {
            console.log('Component mounted.')
        },
  data() {
    return {
      books: [],
      book: {
        id: '',
        title: ''
      },
      book_id: '',
      edit: false,
      headers: new Headers(
          {   'Content-Type':'application/json',
              'Authorization': 'Bearer '+localStorage.getItem('token')
          }
      )
    };
  },

  created() {
    this.fetchBooks();
  },

  methods: {
    fetchBooks(page_url) {
      let vm = this;
      page_url = page_url || '/api/book';
      fetch(page_url,{
          method:"GET",
          headers: this.headers
        })
        .then(res => res.json())
        .then(res => {
          this.books = res.data;
        })
        .catch(err => console.log(err));
    },

    deleteBook(id, type) {
        if (confirm('Are You Sure?')) {
        fetch(`api/book/${id}/${type}`, {
            method: 'delete',
            headers: this.headers
        })
            .then(res => res.json())
            .then(data => {
            alert('Book Removed');
            this.fetchBooks();
            })
            .catch(err => console.log(err));
        }
    },



    addBook() {
      if (this.edit === false) {
        // Add
        fetch('api/book', {
          method: 'post',
          body: JSON.stringify(this.book),
          headers: this.headers
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Book Added');
            this.fetchBooks();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/book', {
          method: 'put',
          body: JSON.stringify(this.book),
          headers: this.headers
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Book Updated');
            this.fetchBooks();
          })
          .catch(err => console.log(err));
      }
    },
    editBook(book) {
      this.edit = true;
      this.book.id = book.id;
      this.book.book_id = book.id;
      this.book.title = book.title;
    },
    clearForm() {
      this.edit = false;
      this.book.id = null;
      this.book.book_id = null;
      this.book.title = '';
    }
  }
};
</script>
