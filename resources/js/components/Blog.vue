<template>
    <div class="container">
        <h2>Blogs</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li 
                    v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                        <a class="page-link" href="#" @click="fetchApi(pagination.prev_page_url)">Previous</a>
                </li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchApi(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
        <div class="card card-body" v-for="blog in blogs" v-bind:key="blog.student_id">
            <h3> Name : {{blog.name}} </h3>
            <p> Age : {{blog.age}} </p>
            <p> Student Year : {{blog.studentYear}} </p>
            <p> Course : {{blog.course}} </p>
        </div>
    </div>
</template>

<script>
import Axios from 'axios'
export default {
    data() {
        return {
            blogs: [],
            blog: {
                id: '',
                name: '',
                age: 0,
                studentYear: '',
                course: ''
            },
            blog_id: '',
            pagination: {},
            edit: false
        }
    },
    created() {
        this.fetchApi();

    },

    methods: {
        fetchApi(api) {
            let vm = this
            api = api || 'api/student'
            Axios.get(api)
                .then(res => {
                    console.log(res.data.data)
                    vm.blogs = res.data.data.data
                    vm.makePagination(res.data.data, res.data.data);
                })
                .catch(err => {
                    console.log(err)
                })
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination
        }
    }
}
</script>