<script lang="ts">
	import Header from '$lib/components/header.svelte';

	export let data;
</script>

<div class="page">
	<div class="header">
		<Header />
	</div>
	<div class="page-content">
		<h1 class="title">Hello {data.user?.name ?? 'there'}</h1>
		{#if data.user === null}
			<p>You are not logged in.</p>
			<a href="/login" class="btn">Login</a>
			<a href="/register" class="btn">Register</a>
		{:else}
			<a href="/logout" class="btn">Logout</a>
			<a href="/profile" class="btn">Profile</a>
		{/if}
	</div>
</div>

<style lang="scss">
    .header{
        margin-bottom: size(8);
    }
	.page-content {
		@include content-width;
	}
</style>
