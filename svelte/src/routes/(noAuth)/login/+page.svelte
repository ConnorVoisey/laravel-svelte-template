<script lang="ts">
	import { goto } from '$app/navigation';
	import Field from '$lib/components/field.svelte';
	import Checkbox from '$lib/components/fields/checkbox.svelte';
	import { fetchClient } from '$lib/js/fetchClient';

	type FieldName = 'email' | 'password';
	type Errors = { [k in FieldName]?: string[] };

	const body = {
		email: '',
		password: '',
		rememberMe: false
	};
	let errors: Errors = {};
	let globalError = '';

	async function login() {
		// do client validation here

		// clear previous errors
		globalError = '';

		// send request
		const { data, error } = await fetchClient.POST('/auth/login', { body });
		console.log({ data, error });
		if (error === undefined) return goto('/', { invalidateAll: true });
		globalError = error.message;
	}
</script>

<form on:submit|preventDefault={login}>
	<fieldset>
		<legend class="title">Login</legend>
		{#if globalError}
			<p>{globalError}</p>
		{/if}
		{#if errors.email}
			<p class="error">{errors.email}</p>
		{/if}
		<Field
			name="email"
			label="Email"
			type="email"
			errors={errors.email}
			required={true}
			bind:value={body.email}
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>Email</title><path
					d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z"
				/></svg
			>
		</Field>
		<Field
			name="password"
			label="Password"
			errors={errors.password}
			required={true}
			bind:value={body.password}
			type="password"
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>Password</title><path
					d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"
				/></svg
			>
		</Field>
		<Checkbox label="Remember me" bind:checked={body.rememberMe} />
		<div class="row-link">
			<a href="/forgot-password" class="link">Forgot Password</a>
			<a href="/" class="link">Home</a>
		</div>
		<button class="btn-primary">Login</button>
	</fieldset>
</form>

<style lang="scss">
	fieldset {
		display: flex;
		flex-direction: column;
		gap: size(4);
		.title {
			margin-bottom: size(4);
		}
	}
	.row-link {
		display: flex;
		gap: size(4);
		justify-content: space-between;
		flex-wrap: wrap;
	}
</style>
