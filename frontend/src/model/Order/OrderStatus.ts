import Order from "@/model/Order/Order";

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


    static pending(): OrderStatus {
        return new OrderStatus(this.PENDING);
    }

    static completed(): OrderStatus {
        return new OrderStatus(this.COMPLETED);
    }
}
