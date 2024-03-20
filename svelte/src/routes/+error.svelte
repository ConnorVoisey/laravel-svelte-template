<script lang="ts">
	import '../styles/main.scss';
	import BackgroundSvg from '$lib/components/backgroundSvg.svelte';
	import { page } from '$app/stores';
</script>

<BackgroundSvg>
	<div class="page">
		<main>
			<h1 class="title">Error</h1>
			<h2 class="subtitle">{$page.error?.message}</h2>
			<a href="/" class="link">Back Home</a>
		</main>
	</div>
</BackgroundSvg>

<style lang="scss">
	.page {
		min-height: 100vh;
		display: flex;
		flex-direction: column;
		header {
			display: flex;
			flex-direction: row-reverse;
			padding: size(8) size(16);
		}
		main {
			@include content-width;
			flex: 1 1 0;
			display: flex;
			flex-direction: column;
			justify-content: center;
			gap: size(4);
			.title {
				font-size: 40px;
				line-height: 1.2rem;
			}
			.subtitle {
				font-size: 30px;
			}
		}
	}
</style>
