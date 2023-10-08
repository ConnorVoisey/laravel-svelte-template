<h1>Welcome to SvelteKit</h1>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>

<div class="grid">
	<div class="left">Left</div>
	<div class="right">Right</div>
</div>

<style lang="scss">
	.grid {
		display: grid;
		grid-template-columns: 48px calc(100% - 48px);
		transition: 1000ms;
		&:hover {
			grid-template-columns: calc(100% - 48px) 48px;
		}
	}
	.right {
		background-color: red;
	}
	.left {
		background-color: blue;
	}
</style>
