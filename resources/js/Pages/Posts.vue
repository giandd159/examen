<template>
    <div>
      <h1>Posts</h1>
      <Link href="/posts/create" class="btn btn-primary">Create Post</Link>
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in posts" :key="post.id">
            <td>{{ post.title }}</td>
            <td>
              <Link :href="`/posts/${post.id}/edit`" class="btn btn-warning">Editar</Link>
              <form :action="`/posts/${post.id}`" method="POST" @submit.prevent="destroy(post.id)">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import { Inertia } from '@inertiajs/inertia';
  
  export default {
    props: {
      posts: Array,
    },
    methods: {
      destroy(id) {
        if (confirm('Are you sure you want to delete this post?')) {
          Inertia.delete(`/posts/${id}`);
        }
      },
    },
    computed: {
      csrf() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      },
    },
  };
  </script>