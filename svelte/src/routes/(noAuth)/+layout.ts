import { axios } from '$lib/js/axios';

export const load = async function () {
	const csrfToken = (await axios.get('/sanctum/csrf-cookie')).data;
	axios.defaults.headers['X-XSRF-TOKEN'] = csrfToken;
	return {
		csrfToken
	};
};
