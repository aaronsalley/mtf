export const DO_SOMETHING = 'DO_SOMETHING'

export function doSomething(input:string) {
  return {
    type: DO_SOMETHING,
    input
  }
}
