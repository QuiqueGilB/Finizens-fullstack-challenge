import HttpClient from "@/api/HttpClient";

export default class FetchHttpClient implements HttpClient {

    get<T>(
        url: string,
        headers: {} | null = null,
        query: { [key: string]: any } | null = null,
    ): Promise<T> {
        return FetchHttpClient.request<T>('GET', url, headers || {}, query || {}, null);
    }

    post(
        url: string,
        headers: { [key: string]: string } | null,
        body: {} | null
    ): any {
        return FetchHttpClient.request('POST', url, headers || {}, {}, body);
    }

    put(
        url: string,
        headers: { [key: string]: string } | null,
        body: {} | null
    ): any {
        return FetchHttpClient.request('PUT', url, headers || {}, {}, body);
    }


    private static request<T>(
        method: "GET" | "POST" | "PUT" | "PATH" | "DELETE",
        url: string,
        headers: { [key: string]: string },
        query: { [key: string]: string },
        body: {} | null
    ): Promise<T> {
        const httpUrl = new URL(url);

        for (const queryKey in query) {
            httpUrl.searchParams.append(queryKey, query[queryKey]);
        }

        const requestData: RequestInit = {
            method,
            headers: headers || {},
            body: JSON.stringify(body)
        };

        if ('GET' === method) {
            delete requestData.body;
        }

        return fetch(httpUrl.toString(), requestData)
            .then(response => {
                if (response.status < 200 || response.status >= 300) {
                    throw response;
                }

                const contentType = response.headers.get('Content-Type');

                if ('application/json' === contentType) {
                    return response.json() as Promise<T>;
                }

                if ((contentType || '').startsWith('text\\')) {
                    return response.text() as unknown as Promise<T>;
                }

                return response as unknown as Promise<T>;
            })
            .catch((error) => {
                throw error
            })
    }
}