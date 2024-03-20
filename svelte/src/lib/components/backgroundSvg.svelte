<svg
	class="background"
	xmlns="http://www.w3.org/2000/svg"
	version="1.1"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	width="1440"
	height="560"
	preserveAspectRatio="none"
	viewBox="0 0 1440 560"
>
	<g mask="url(&quot;#SvgjsMask1214&quot;)" fill="none">
		<rect width="1440" height="560" x="0" y="0" fill="url(&quot;#SvgjsLinearGradient1215&quot;)" />
		<path d="M1440 0L785.15 0L1440 218.63z" fill="rgba(255, 255, 255, .1)" />
		<path d="M785.15 0L1440 218.63L1440 266.13L445.4 0z" fill="rgba(255, 255, 255, .075)" />
		<path d="M445.4 0L1440 266.13L1440 402.47L434.87 0z" fill="rgba(255, 255, 255, .05)" />
		<path
			d="M434.87 0L1440 402.47L1440 504.32000000000005L234.73000000000002 0z"
			fill="rgba(255, 255, 255, .025)"
		/>
		<path d="M0 560L342.15 560L0 318.5z" fill="rgba(0, 0, 0, .1)" />
		<path d="M0 318.5L342.15 560L646.3199999999999 560L0 166.09z" fill="rgba(0, 0, 0, .075)" />
		<path
			d="M0 166.09000000000003L646.3199999999999 560L773.0999999999999 560L0 146.79000000000002z"
			fill="rgba(0, 0, 0, .05)"
		/>
		<path
			d="M0 146.79000000000002L773.0999999999999 560L1026.9399999999998 560L0 96.50000000000003z"
			fill="rgba(0, 0, 0, .025)"
		/>
	</g>
	<defs>
		<mask id="SvgjsMask1214">
			<rect width="1440" height="560" fill="#ffffff" />
		</mask>
		<linearGradient
			x1="84.72%"
			y1="139.29%"
			x2="15.28%"
			y2="-39.29%"
			gradientUnits="userSpaceOnUse"
			id="SvgjsLinearGradient1215"
		>
			<stop stop-color="hsl(var(--clr-surface-0))" offset="0" />
			<stop stop-color="hsl(var(--clr-surface-1))" offset="1" />
		</linearGradient>
	</defs>
</svg>
<slot />

<style lang="scss">
	.background {
		position: fixed;
		top: 0;
		height: 100svh;
		width: 1440px;
		min-width: 100%;
		z-index: -1;
	}
</style>
