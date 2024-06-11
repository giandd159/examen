<template>
  <div>
    <h1>Logs del Post {{ post.id }}</h1>
    <ul class="logs-list">
      <li v-for="log in logs" :key="log.id" class="log-item">
        <div class="log-info">
          <p><strong>Usuario:</strong> {{ log.user_id }}</p>
          <p><strong>Acción:</strong> {{ log.action }}</p>
          <p><strong>Fecha de Creación:</strong> {{ log.created_at }}</p>
          <p><strong>Fecha de Actualización:</strong> {{ log.updated_at }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
    logs: Array,
  },
}
</script>

<style scoped>
.logs-list {
  list-style-type: none;
  padding: 0;
}

.log-item {
  border: 1px solid #ccc;
  margin-bottom: 10px;
  padding: 10px;
}

.log-info {
  margin-left: 20px; /* Indentación para separar la información del log */
}
</style>