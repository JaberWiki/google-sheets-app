<template>
  <div>
    <header>
      <h1>Google Sheets App</h1>
      <nav>
        <router-link to="/">Home</router-link>
        <router-link to="/dashboard">Dashboard</router-link>
      </nav>
    </header>
    <main>
      <router-view></router-view> <!-- Component for the current route -->
    </main>
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>

<style scoped>
header {
  background-color: #4CAF50;
  color: white;
  padding: 1rem;
  text-align: center;
}
nav {
  margin-top: 1rem;
}
nav a {
  margin: 0 1rem;
  color: white;
  text-decoration: none;
}
main {
  padding: 2rem;
}
</style>
