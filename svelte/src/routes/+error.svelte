<script lang="ts">
	import '../styles/main.scss';
	import { page } from '$app/stores';
</script>

<div class="page">
	<h1 class="title">Error</h1>
	<h2 class="subtitle">{$page.error?.message}</h2>
	<a href="/" class="link">Back Home</a>
</div>

<style lang="scss">
	.page {
		@include content-width;
		display: flex;
		flex-direction: column;
		justify-content: center;
		min-height: 100svh;
		gap: size(4);
		.title {
			font-size: 40px;
			line-height: 1.2rem;
		}
		.subtitle {
			font-size: 30px;
		}
	}
</style>
