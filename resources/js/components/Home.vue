<template>
    <div>
        <h1 v-if="this.$store.state.isLoggedIn">
        <router-link :to="{ name: 'dashboard' }">Dashboard</router-link>
        </h1>
        <h1 v-if="!this.$store.state.isLoggedIn">
            <router-link :to="{ name: 'dashboard' }">Login</router-link></h1>
    </div>

</template>
