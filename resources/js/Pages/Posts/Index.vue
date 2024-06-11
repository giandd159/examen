<template>
  <div>
    <h1>Posts</h1>
    <Link href="/posts/create" class="btn btn-green">Crear Post</Link>
    <form action="/logout" method="POST" @submit.prevent="logout" style="display: inline;">
      <input type="hidden" name="_token" :value="csrf">
      <button type="submit" class="btn btn-red">Cerrar sesión</button>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Titulo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="post in posts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>
            <Link :href="`/posts/${post.id}/edit`" class="btn btn-warning">Editar</Link>
            <form :action="`/posts/${post.id}`" method="POST" @submit.prevent="destroy(post.id)">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" :value="csrf">
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <Link :href="`/posts/${post.id}/logs`" class="btn btn-warning">Ver Logs</Link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    posts: Array,
  },
  data() {
    return {
      csrf: '', // Variable para almacenar el token CSRF
    };
  },
  methods: {
    destroy(id) {
      if (confirm('¿Estás seguro de que quieres eliminar este post?')) {
        Inertia.delete(`/posts/${id}`);
      }
    },
    logout() {
      // Realiza la solicitud de logout
      Inertia.post('/logout').then(() => {
        // Redirecciona a la página de inicio de sesión después de cerrar sesión
        window.location = '/login'; // Redirecciona directamente en lugar de usar Inertia.visit
      });
    },
  },
  mounted() {
    // Obtener el token CSRF al montar el componente
    this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  },
  components: {
    Link,
  },
};
</script>