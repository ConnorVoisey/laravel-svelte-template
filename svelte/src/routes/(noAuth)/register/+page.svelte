<script lang="ts">
	import { goto } from '$app/navigation';
	import Field from '$lib/components/field.svelte';
	import { axios } from '$lib/js/axios';
	import type { AxiosError } from 'axios';

	type FieldName = 'email' | 'name' | 'password' | 'password_confirmation';
	type Errors = { [k in FieldName]?: string[] };

	// define the response types, this is optional but it will likely prevent errors and save you time
	type ResData = {
		foo: string;
	};
	type ErrorData = {
		errors: Errors;
		message: string;
	};

	const body = {
		name: '',
		email: '',
		password: '',
		password_confirmation: ''
	};
	let errors: Errors = {};
	let globalError = '';

	function register() {
		// do client validation here

		// clear previous errors
		globalError = '';
		errors = {};

		// send request
		axios
			.post<ResData>('register', body)
			.then((res) => goto('/'))
			.catch((err: AxiosError<ErrorData>) => {
				if (!err.response?.data.errors) {
					// something else went wrong in the request, could be csrf, network issue, database issue or anything
					// If this is reached we can't know the best thing to tell the user so we have to give a generic error
					globalError = 'Something went wrong try again later';
					return;
				}
				errors = err.response?.data?.errors ?? {};
			});
	}
</script>

<form on:submit|preventDefault={register}>
	<fieldset>
		<legend class="title">Register</legend>
		{#if globalError}
			<p class="error">{globalError}</p>
		{/if}
		<Field name="name" label="Name" errors={errors.name} bind:value={body.name} required>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>Name</title><path
					d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"
				/></svg
			>
		</Field>
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
		<Field
			name="password_confirmation"
			label="Password Confirmation"
			placeholder="Confirm your password"
			errors={errors.password_confirmation}
			required={true}
			bind:value={body.password_confirmation}
			type="password"
		>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>Password</title><path
					d="M12,17C10.89,17 10,16.1 10,15C10,13.89 10.89,13 12,13A2,2 0 0,1 14,15A2,2 0 0,1 12,17M18,20V10H6V20H18M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6C4.89,22 4,21.1 4,20V10C4,8.89 4.89,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"
				/></svg
			>
		</Field>
		<button class="btn-primary">Register</button>
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
</style>
