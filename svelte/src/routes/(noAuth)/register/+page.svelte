<script lang="ts">
	import { axios } from '$lib/js/axios';

	const body = {
		email: '',
		password: ''
	};
	let passwordConf = '';

	async function login() {
		//TODO: check if password matches passwordConf
		const res = await axios.post('register', body);
		console.log(res);
	}
</script>

<form on:submit|preventDefault={login}>
	<fieldset>
		<legend>Register</legend>
		<label>
			<p>Email</p>
			<input type="email" bind:value={body.email} required />
		</label>
		<label>
			<p>Password</p>
			<input type="password" bind:value={body.password} required />
		</label>
		<label>
			<p>Confirm Password</p>
			<input type="password" bind:value={passwordConf} />
		</label>
		<button>Register</button>
	</fieldset>
</form>
