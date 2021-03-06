import OrderType from "@/model/Order/OrderType";
import OrderStatus from "@/model/Order/OrderStatus";

export default class Order {
    constructor(
        public readonly id: number,
        public readonly portfolioId: number,
        public readonly allocationId: number,
        public readonly shares: number,
        public readonly orderType: OrderType,
        public readonly orderStatus: OrderStatus,
    ) {
    }
}