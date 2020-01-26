<template>
    <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Home automation</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul v-if="!$auth.check()" class="navbar-nav">
				<!--UNLOGGED-->
				<li v-for="(route, key) in routes.unlogged" v-bind:key="route.path" class="nav-item">
					<router-link  :to="{ name : route.path }" :key="key" class="nav-link">
						{{route.name}}
					</router-link>
				</li>
			</ul>
			<ul v-if="$auth.check(0)" class="navbar-nav">
				<li v-for="(route, key) in routes.user" v-bind:key="route.path" class="nav-item">
					<router-link  :to="{ name : route.path }" :key="key" class="nav-link">
						{{route.name}}
					</router-link>
				</li>
				<li class="nav-item">
					<a href="#" @click.prevent="$auth.logout()" class="nav-link">Logout</a>
				</li>
			</ul>
			<ul v-if="$auth.check(1)" class="navbar-nav">
				<li v-for="(route, key) in routes.admin" v-bind:key="route.path" class="nav-item">
					<router-link  :to="{ name : route.path }" :key="key" class="nav-link">
						{{route.name}}
					</router-link>
				</li>
				<li class="nav-item">
					<a href="#" @click.prevent="$auth.logout()" class="nav-link">Logout</a>
				</li>
			</ul>
		</div>
    </nav>
</template>
<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Rejestracja',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],
          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'home'
            },
            {
              name: 'Dodaj urządzenie',
              path: 'add-device'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            },
            {
              name: 'Dodaj urządzenie',
              path: 'add-device'
            }
          ]
        }
      }
    },
    mounted() {
      //
    }
  }
</script>