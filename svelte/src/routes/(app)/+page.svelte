<script lang="ts">
	import { goto } from '$app/navigation';
	import { fetchClient } from '$lib/js/fetchClient';
	import { error } from '@sveltejs/kit';

	export let data;

	const logout = async () => {
		const res = await fetchClient.POST('/auth/logout');
		if (res.error) error(500, { message: 'Something went wrong' });
		goto('/login', { invalidateAll: true });
	};
</script>

<h1 class="title">Hello {data.user?.name ?? 'there'}</h1>
<a href="/todos" class="btn">Todos</a>
{#if data.user === null}
	<p>You are not logged in.</p>
	<a href="/login" class="btn">Login</a>
	<a href="/register" class="btn">Register</a>
{:else}
	<button class="btn" on:click={logout}>Logout</button>
	<a href="/profile" class="btn">Profile</a>
{/if}
