/// <reference types="@sveltejs/kit" />

// See https://kit.svelte.dev/docs#typescript
// for information about these interfaces
declare global {
	namespace App {
		interface Locals {
			user: User?;
		}

		interface PageData {
			user: User?;
		}

		// interface Platform {}

		// interface Session {}

		// interface Stuff {}
	}
	interface User {
		id: string;
		name: string;
		email: string;
		email_verified_at: string | null;
		created_at: string;
		updated_at: string;
	}
}

export {};
