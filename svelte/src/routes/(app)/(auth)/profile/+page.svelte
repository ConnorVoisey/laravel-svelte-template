<script lang="ts">
	export let data;

	// User will always be defined here since the hooks.server will redirect the user if they are not
	const user = data.user!;

	console.log(data);

	const resetPassword = async () => {};
</script>

<h1 class="title">User</h1>
<p>Name: {user.name}</p>
<p>Email: {user.email}</p>
<p>Created at: {new Date(user.created_at).toLocaleString()}</p>
<p>Updated at: {new Date(user.updated_at).toLocaleString()}</p>

<button class="btn-primary" on:click={resetPassword}>Reset password</button>
