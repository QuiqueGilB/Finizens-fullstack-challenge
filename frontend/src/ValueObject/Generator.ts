export default class Generator {

    static randomInt(): number {
        return Generator.randomIntBetween(1, 999999999)
    }

    static randomIntBetween(min: number, max: number): number {
        return Math.floor((Math.random() * max) + min)
    }
}