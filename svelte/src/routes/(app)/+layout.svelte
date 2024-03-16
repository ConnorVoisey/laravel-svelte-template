<script lang="ts">
	import '../../styles/main.scss';
	import Header from '$lib/components/header.svelte';
	import { onNavigate } from '$app/navigation';

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
	export let data;
</script>

<div class="page">
	<div class="header">
		<Header user={data.user} />
	</div>
	<div class="page-content">
		<slot />
	</div>
</div>

<style lang="scss">
	:global(::view-transition-old(root), ::view-transition-new(root)) {
		animation-duration: 50ms;
		width: 100%;
		height: 100%;
	}
	.header {
		margin-bottom: size(8);
	}
	.page-content {
		@include content-width;
	}
</style>
