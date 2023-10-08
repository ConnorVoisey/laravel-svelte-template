<script lang="ts">
	export let data;
</script>

<h1 class="title">Hello {data.user?.name ?? 'there'}</h1>
{#if data.user === null}
	<p>You are not logged in.</p>
	<a href="/login" class="btn">Login</a>
	<a href="/register" class="btn">Register</a>
{:else}
	<a href="/logout" class="btn">Logout</a>
	<a href="/profile" class="btn">Profile</a>
{/if}
