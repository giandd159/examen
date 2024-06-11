<template>
    <div>
      <h1>Crear Post</h1>
      <form @submit.prevent="submit">
        <div class="form-group">
          <label for="title">Título</label>
          <input v-model="form.title" type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="form-group">
          <label for="body">Cuerpo</label>
          <textarea v-model="form.body" name="body" class="form-control" id="body" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
       

      </form>
      <div style="display: flex; justify-content: space-between; margin-top: 10px;">
        <Link href="/posts" class="btn btn-primary">Volver</Link>

      </div>
    </div>
  </template>
  
  <script>
  import { Inertia } from '@inertiajs/inertia';
  import { Link } from '@inertiajs/inertia-vue3';
  export default {
    data() {
      return {
        form: {
          title: '',
          body: '',
        },
      };
    }, 
    components: {
      Link,
    },
    methods: {
      submit() {
        Inertia.post('/posts', this.form);
      },
    },
  };
  </script>