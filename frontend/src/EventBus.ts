export default class EventBus {
    public static subscribers: { [key: string]: any[] } = {};

    static emit(name: string, params?: any): void {
        if (name in this.subscribers) {
            this.subscribers[name].forEach((fn: any) => {
                fn(params);
            });
        }
    }

    static on(name: string, fn: any) {
        if (!(name in this.subscribers)) {
            this.subscribers[name] = []
        }

        this.subscribers[name].push(fn);
    }
}