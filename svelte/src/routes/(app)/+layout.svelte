<script lang="ts">
	import '../../styles/main.scss';
	import Header from '$lib/components/header.svelte';
	import { onNavigate } from '$app/navigation';
	import { page } from '$app/stores';
	import NavBar from '$lib/components/navBar.svelte';

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
	<NavBar
		selectedPage={$page.url.pathname}
		items={[
			{
				href: '/',
				label: 'Home',
				svgPath:
					'M12 5.69L17 10.19V18H15V12H9V18H7V10.19L12 5.69M12 3L2 12H5V20H11V14H13V20H19V12H22'
			},
			{
				href: '/todos',
				label: 'Todos',
				svgPath:
					'M12 12H17V17H12V12M19 3H18V1H16V3H8V1H6V3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M19 5V7H5V5H19M5 19V9H19V19H5Z'
			},
			{
				href: '/profile',
				label: 'Profile',
				svgPath:
					'M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,6A2,2 0 0,0 10,8A2,2 0 0,0 12,10A2,2 0 0,0 14,8A2,2 0 0,0 12,6M12,13C14.67,13 20,14.33 20,17V20H4V17C4,14.33 9.33,13 12,13M12,14.9C9.03,14.9 5.9,16.36 5.9,17V18.1H18.1V17C18.1,16.36 14.97,14.9 12,14.9Z'
			}
		]}
	/>
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
	.page {
		height: 100svh;
		display: flex;
		flex-direction: column;
	}
	.page-content {
		@include content-width;
		flex: 1 1 0;
	}
</style>
