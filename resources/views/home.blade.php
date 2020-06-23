@extends('layouts.app')

@section('content')
<div class="container">

    <div id="app">

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-3">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addmodal">
                    Add Books
                    </button>

                </div>
                <!-- Modal -->
                <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addmodal">Add Books</h5>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputTitle">Book Name</label>
                            <input type="text" class="form-control" id="title" name="title" v-model="newBook.title">
                            <small class="form-text text-muted">Enter any book name here..</small>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" @click.prevent="addBook()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
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
                            <tr v-for="item in items">
                            <th scope="row">1</th>
                            <td>@{{item.title}}</td>
                            <td>
                                <a href="#"><i class="fa fa-edit fa-lg" style="color:#d9d9d9"></i></a>
                                <a href="#"><i class="fa fa-trash fa-lg" style="color:#d9d9d9"></i></a>
                            </td>
                            </tr>
                        </tbody>
                        </table>

                </div>
            </div>
       </div>

       <p class="text-center alert alert-danger" v-bind:class="{hidden: hasError}">Please Enter Book Name !!</p>

    </div>
</div>
@endsection
