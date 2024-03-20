<script lang="ts">
	import '../../styles/main.scss';
	import { onNavigate } from '$app/navigation';
	import BackgroundSvg from '$lib/components/backgroundSvg.svelte';
	import ThemeSelector from '$lib/components/themeSelector.svelte';

	onNavigate((nav) => {
		// @ts-expect-error
		if (!document.startViewTransition) return;
		return new Promise((res) => {
			// @ts-expect-error
			document.startViewTransition(async () => {
				res();
				await nav.complete;
			});
		});
	});
</script>

<BackgroundSvg>
	<div class="page">
		<header>
			<ThemeSelector />
		</header>
		<main>
			<div class="page-content card-lg">
				<slot />
			</div>
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
			flex: 1 1 0;
			display: grid;
			align-items: center;
			justify-items: center;
			align-items: center;
			@include content-width(450px);
			width: 100%;
			.page-content {
				width: 100%;
				background-color: surface(1);
				display: grid;
				gap: size(8);
				view-transition-name: card;
			}
		}
	}
</style>
