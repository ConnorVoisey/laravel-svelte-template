import { env } from "$env/dynamic/public";

import axiosImport from "axios";
const getCookie = (name: string) => {
	if (document === undefined) return undefined;
	const cookie: Record<string, string> = {};
    console.log({document, cookieStr: document.cookie});
	for (const el of document.cookie.split(";")) {
		const split = el.split("=");
		cookie[split[0].trim()] = split.slice(1).join("=");
	}
	return cookie[name];
};

export const axios = axiosImport.create({
	baseURL: env.PUBLIC_API_URL,
	timeout: 2000,
	headers: {
        "X-Requested-With": "XMLHttpRequest",
        Accept: "application/json",
        'Content-Type': 'application/json' 
    },
	withCredentials: true,
});

axios.interceptors.request.use(async (req) => {
	if (req.method === "get") return req;

	let csrfToken = getCookie("XSRF-TOKEN");
	if (!csrfToken) {
		csrfToken = await axios.get("/sanctum/csrf-cookie", {withCredentials: true});
		csrfToken = getCookie("XSRF-TOKEN");
	}
    console.log({csrfToken});

	req.headers["X-XSRF-TOKEN"] = csrfToken;
	return req;
});
