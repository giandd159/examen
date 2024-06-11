<template>
    <div>
        <h1>Login</h1>
        <a :href="route('auth.google')" class="btn btn-primary">Login with Google</a>
    </div>
</template>

<script>
export default {
    name: 'Login',
    methods: {
        route,
    },
};
</script>

<style scoped>
/* Tu estilo aquí */
</style>