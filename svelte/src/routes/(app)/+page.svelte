<script lang="ts">
	export let data;
	import { fetchClient } from '$lib/js/fetchClient';
	import { onMount } from 'svelte';

	const getUser = async () => {
		const { data, error } = await fetchClient.GET('/user');
		console.log({ data, error, func: 'get user' });
	};
	onMount(getUser);
</script>

<h1 class="title">Hello {data.user?.name ?? 'there'}</h1>
<a href="/todo" class="btn">Todos</a>
{#if data.user === null}
	<p>You are not logged in.</p>
	<a href="/login" class="btn">Login</a>
	<a href="/register" class="btn">Register</a>
{:else}
	<a href="/logout" class="btn">Logout</a>
	<a href="/profile" class="btn">Profile</a>
{/if}
