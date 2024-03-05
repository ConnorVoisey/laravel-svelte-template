<script lang="ts">
	export let user: User | null;
	let isMenuOpen = false;
</script>

<div class="wrapper">
	{#if user}
		<button class="btn-primary" on:click={() => (isMenuOpen = !isMenuOpen)}>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
				><title>User</title><path
					d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,6A2,2 0 0,0 10,8A2,2 0 0,0 12,10A2,2 0 0,0 14,8A2,2 0 0,0 12,6M12,13C14.67,13 20,14.33 20,17V20H4V17C4,14.33 9.33,13 12,13M12,14.9C9.03,14.9 5.9,16.36 5.9,17V18.1H18.1V17C18.1,16.36 14.97,14.9 12,14.9Z"
				/></svg
			>
			<p>{user.name}</p>
		</button>
		{#if isMenuOpen}
			<div class="drop-down">
				<a href="/profile" class="link">Profile</a>
				<a data-sveltekit-reload href="/logout" class="link">Logout</a>
			</div>
		{/if}
	{:else}
		<a href="/login" class="link-on-primary">Login</a>
		<a href="/register" class="link-on-primary">Register</a>
	{/if}
</div>

<style lang="scss">
	.wrapper {
		display: flex;
		gap: size(2);
		align-items: center;
		position: relative;
	}

	svg {
		width: size(8);
	}
	.drop-down {
		position: absolute;
		top: 100%;
		background-color: surface(1);
		padding: size(4);
		border-radius: size(4);
		display: flex;
		flex-direction: column;
		gap: size(2);
	}
</style>
