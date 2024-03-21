<script lang="ts">
	export let selectedPage = '/';
	export let items: { href: string; label: string; svgPath: string }[];
	const navPaddingY = 0.5 * 16;
	const navPaddingX = 1 * 16;
	const circleDiameter = 4 * 16;
	let contentWidth = 0;
	$: widthNoPadding = contentWidth - 2 * navPaddingX;
	$: gapWidth = (widthNoPadding - circleDiameter * items.length) / (items.length - 1);
	$: selectedIndex = (() => {
		for (let i = 1; i < items.length; i++) {
			if (selectedPage === items[i].href) return i;
		}
		return 0;
	})();
	$: indicatorOffset = (gapWidth + circleDiameter) * selectedIndex;
</script>

<nav
	style:--nav-padding-y={`${navPaddingY}px`}
	style:--nav-padding-x={`${navPaddingX}px`}
	style:--circle-diameter={`${circleDiameter}px`}
	style:--offset={`${indicatorOffset}px`}
>
	<div class="content" bind:clientWidth={contentWidth}>
		{#each items as item}
			<a href={item.href} class:selected={selectedPage === item.href}>
				<p>{item.label}</p>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path d={item.svgPath} />
				</svg>
			</a>
		{/each}
	</div>
</nav>

<style lang="scss">
	.content {
		@include content-width;
		display: flex;
		justify-content: space-between;
	}
	nav {
		background: surface(1);
		padding: size(0);
		.content {
			padding-block: var(--nav-padding-y);
			padding-inline: var(--nav-padding-x);
		}
		a {
			display: grid;
			grid-template-rows: 1fr;
			grid-template-columns: 1fr;
			border-radius: 50%;
			width: var(--circle-diameter);
			height: var(--circle-diameter);
			align-items: center;
			justify-items: center;
			z-index: 1;
			transition: transform 500ms;
			p {
				grid-area: 1 / 1 / 2 / 2;
				transform: translateY(1.5rem);
				transition: all 500ms;
			}
			svg {
				transform: translateY(-0.5rem);
				display: flex;
				fill: on-surface(0);
				grid-area: 1 / 1 / 2 / 2;
				width: size(7);
				transition: all 500ms;
			}
			&:hover {
				p {
					transform: translateY(0.5rem);
				}
				svg {
					transform: translateY(-1.5rem);
				}
			}
			&.selected {
				svg {
					fill: on-primary(0);
					transform: translateY(calc(-1 * ((var(--nav-padding-y) + (var(--circle-diameter) / 2)))));
				}
				p {
					transform: translateY(0.5rem);
				}
			}
		}
	}
	.content::after {
		@include pseudo;
		transform: translateX(var(--offset))
			translateY(calc(-1 * ((var(--nav-padding-y) + (var(--circle-diameter) / 2)))));
		z-index: 0;
		background: primary(5);
		border-radius: 50%;
		width: var(--circle-diameter);
		height: var(--circle-diameter);
		transition: transform 500ms;
	}
</style>
