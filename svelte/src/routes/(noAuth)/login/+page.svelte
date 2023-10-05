<script lang="ts">
	let email = '',
		password = '';
	async function login() {
		const res = await fetch('http://localhost:8000', {
			method: 'post',
			body: JSON.stringify({ email, password })
		});
		console.log(res);
	}
</script>

<form on:submit|preventDefault={login}>
	<fieldset>
		<legend>Login</legend>
		<label>
			<p>Email</p>
			<input type="email" bind:value={email} />
		</label>
		<label>
			<p>Password</p>
			<input type="password" bind:value={password} />
		</label>
		<button>Login</button>
	</fieldset>
</form>
