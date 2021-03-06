export default class OrderStatus {

    private static readonly PENDING = "pending";
    private static readonly COMPLETED = "completed";

    constructor(
        public readonly value: string
    ) {
        if (OrderStatus.PENDING !== value && OrderStatus.COMPLETED !== value) {
            throw new Error(value);
        }
    }

    public isCompleted(): boolean {
        return OrderStatus.COMPLETED === this.value;
    }

    public isPending(): boolean {
        return OrderStatus.PENDING === this.value;
    }
}
