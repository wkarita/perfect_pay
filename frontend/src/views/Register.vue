<template>
  <div class="container">
    <hr />
    <div class="row">
      <Form
        ref="newRegisterForm"
        @submit="saveRegister"
        :validation-schema="schema"
        v-slot="{ errors }"
      >
        <div class="card p-4 col-9 mx-auto mt-4">
          <h4 class="text-center">Dados do Cliente</h4>
          <div class="mb-3 col-3">
            <label class="form-label">CPF/Cnpj</label>
            <Field
              type="text"
              class="form-control"
              v-model="register.cpfCnpj"
              v-mask="['###.###.###-##', '##.###.###/####-##']"
              masked
              @keyup="searchCpfCnpj()"
              @blur="searchCpfCnpj()"
              :class="{ 'is-invalid': errors.cpfCnpj }"
              name="cpfCnpj"
            />
            <div class="invalid-feedback">{{ errors.cpfCnpj }}</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <Field
              type="text"
              class="form-control"
              v-model="register.name"
              :class="{ 'is-invalid': errors.firstName }"
              name="firstName"
            />
            <div class="invalid-feedback">{{ errors.firstName }}</div>
            <!-- <input type="text" class="form-control" v-model="register.name" /> -->
          </div>
          <div class="mb-3 col-3">
            <label class="form-label">Cep</label>
            <Field
              type="text"
              class="form-control"
              v-model="register.postalCode"
              v-mask="'#####-###'"
              masked
              @keyup="searchPostalCode('person')"
              @blur="searchPostalCode('person')"
              :class="{ 'is-invalid': errors.postalCode }"
              name="postalCode"
            />
            <div class="invalid-feedback">{{ errors.postalCode }}</div>
          </div>
          <div class="row">
            <div class="mb-3 col">
              <label class="form-label">Endereço</label>
              <input
                type="text"
                class="form-control"
                v-model="register.address"
                readonly
              />
            </div>
            <div class="mb-3 col-3">
              <label class="form-label">Número</label>
              <Field
                type="text"
                class="form-control"
                v-model="register.addressNumber"
                :class="{ 'is-invalid': errors.addressNumber }"
                name="addressNumber"
              />
              <div class="invalid-feedback">{{ errors.addressNumber }}</div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col">
              <label class="form-label">Bairro</label>
              <input
                type="text"
                class="form-control"
                v-model="register.province"
                readonly
              />
            </div>
            <div class="mb-3 col-5">
              <label class="form-label">Complemento</label>
              <input
                type="text"
                class="form-control"
                v-model="register.complement"
              />
            </div>
          </div>
          <div class="row">
            <div class="mb-3 col-4">
              <label class="form-label">Estado</label>
              <input
                type="text"
                class="form-control"
                v-model="register.state"
                readonly
              />
            </div>
            <div class="mb-3 col-8">
              <label class="form-label">Cidade</label>
              <input
                type="text"
                class="form-control"
                v-model="register.city"
                readonly
              />
            </div>
          </div>
          <hr />
          <div class="mb-3 col-4">
            <label class="form-label">Forma de Pagamento</label>
            <Field
              class="form-select"
              v-model="register.billingType"
              as="select"
              :class="{ 'is-invalid': errors.billingType }"
              name="billingType"
            >
              <option selected>Selecione ...</option>
              <option value="BOLETO">Boleto</option>
              <option value="CREDIT_CARD">Cartão de Crédito</option>
              <option value="PIX">Pix</option>
            </Field>
            <div class="invalid-feedback">{{ errors.billingType }}</div>
          </div>
          <div
            v-if="
              register.billingType === 'BOLETO' ||
              register.billingType === 'PIX'
            "
          >
            <div class="row">
              <div class="mb-3 col-6">
                <label class="form-label">Valor</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.value"
                  :class="{ 'is-invalid': errors.value }"
                  name="value"
                />
                <div class="invalid-feedback">{{ errors.value }}</div>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Data de vencimento</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.dueDate"
                  v-mask="'##/##/####'"
                  masked
                  :class="{ 'is-invalid': errors.dueDate }"
                  name="dueDate"
                />
                <div class="invalid-feedback">{{ errors.dueDate }}</div>
              </div>
            </div>
          </div>
          <div v-if="register.billingType === 'CREDIT_CARD'">
            <div class="row">
              <div class="mb-3 col-6">
                <label class="form-label">Valor</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.value"
                  :class="{ 'is-invalid': errors.value }"
                  name="value"
                />
                <div class="invalid-feedback">{{ errors.value }}</div>
              </div>
              <div class="mb-3 col-6">
                <label class="form-label">Data de vencimento</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.dueDate"
                  v-mask="'##/##/####'"
                  masked
                  :class="{ 'is-invalid': errors.dueDate }"
                  name="dueDate"
                />
                <div class="invalid-feedback">{{ errors.dueDate }}</div>
              </div>
            </div>
            <hr />
            <h3 class="text-center">Dados do cartão</h3>

            <div class="mb-3">
              <label class="form-label">Nome impresso no cartão</label>
              <Field
                type="text"
                class="form-control"
                v-model="register.holderName"
                :class="{ 'is-invalid': errors.holderName }"
                name="holderName"
              />
              <div class="invalid-feedback">{{ errors.holderName }}</div>
            </div>
            <div class="row">
              <div class="mb-3 col-5">
                <label class="form-label">Número do cartão</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.number"
                  v-mask="'#### #### #### ####'"
                  masked
                  :class="{ 'is-invalid': errors.number }"
                  name="number"
                />
                <div class="invalid-feedback">{{ errors.number }}</div>
              </div>

              <div class="mb-3 col-4">
                <label class="form-label">Data de expiração</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.expiryDate"
                  v-mask="'##/####'"
                  masked
                  :class="{ 'is-invalid': errors.expiryDate }"
                  name="expiryDate"
                />
                <div class="invalid-feedback">{{ errors.expiryDate }}</div>
              </div>

              <div class="mb-3 col">
                <label class="form-label">Código de segurança(cvv)</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.ccv"
                  v-mask="'###'"
                  masked
                  :class="{ 'is-invalid': errors.ccv }"
                  name="ccv"
                />
                <div class="invalid-feedback">{{ errors.ccv }}</div>
              </div>
            </div>

            <hr />

            <h5 class="text-center">Dados do dono do cartão</h5>
            <div class="mb-3">
              <label class="form-label">Nome</label>
              <Field
                type="text"
                class="form-control"
                v-model="register.cardName"
                :class="{ 'is-invalid': errors.cardName }"
                name="cardName"
              />
              <div class="invalid-feedback">{{ errors.cardName }}</div>
            </div>
            <div class="row">
              <div class="mb-3 col-3">
                <label class="form-label">CPF/Cnpj</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.cardCpfCnpj"
                  v-mask="['###.###.###-##', '##.###.###/####-##']"
                  masked
                  :class="{ 'is-invalid': errors.cardCpfCnpj }"
                  name="cardCpfCnpj"
                />
                <div class="invalid-feedback">{{ errors.cardCpfCnpj }}</div>
              </div>
              <div class="mb-3 col-5">
                <label class="form-label">E-mail</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.cardEmail"
                  :class="{ 'is-invalid': errors.cardEmail }"
                  name="cardEmail"
                />
                <div class="invalid-feedback">{{ errors.cardEmail }}</div>
              </div>
              <div class="mb-3 col">
                <label class="form-label">Telefone</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.cardPhone"
                  v-mask="['(##) ####-####', '(##) #####-####']"
                  masked
                  :class="{ 'is-invalid': errors.cardPhone }"
                  name="cardPhone"
                />
                <div class="invalid-feedback">{{ errors.cardPhone }}</div>
              </div>
            </div>
            <div class="mb-3 col-3">
              <label class="form-label">Cep</label>
              <Field
                type="text"
                class="form-control"
                v-model="register.cardPostalCode"
                @keyup="searchPostalCode('card')"
                v-mask="'#####-###'"
                masked
                :class="{ 'is-invalid': errors.cardPostalCode }"
                name="cardPostalCode"
              />
              <div class="invalid-feedback">{{ errors.cardPostalCode }}</div>
            </div>
            <div class="row">
              <div class="mb-3 col">
                <label class="form-label">Endereço</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="register.cardAddress"
                  readonly
                />
              </div>
              <div class="mb-3 col-3">
                <label class="form-label">Número</label>
                <Field
                  type="text"
                  class="form-control"
                  v-model="register.cardAddressNumber"
                  :class="{ 'is-invalid': errors.cardAddressNumber }"
                  name="cardAddressNumber"
                />
                <div class="invalid-feedback">
                  {{ errors.cardAddressNumber }}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col">
                <label class="form-label">Bairro</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="register.cardProvince"
                  readonly
                />
              </div>
              <div class="mb-3 col-5">
                <label class="form-label">Complemento</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="register.cardComplement"
                />
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-4">
                <label class="form-label">Estado</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="register.cardState"
                  readonly
                />
              </div>
              <div class="mb-3 col-8">
                <label class="form-label">Cidade</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="register.cardCity"
                  readonly
                />
              </div>
            </div>
          </div>
          <div class="mt-2">
            <button
              class="btn btn-primary text-white"
              type="submit"
              :disabled="disabledButton"
            >
              Salvar e Gerar Cobrança
            </button>
          </div>
        </div>
      </Form>
    </div>
    <div>
      <b-modal
        v-model="showModal"
        hide-footer
        @hidden="resetForm()"
        no-close-on-esc
        no-close-on-backdrop
        centered
      >
        <div class="text-center">
          <h5>Obrigado por utilizar a PerfectPay.</h5>
        </div>
        <div class="form-label text-center mt-4">
          <div v-if="dataAbilling.billingType === 'BOLETO'">
            <a
              :href="dataAbilling.bankSlipUrl"
              target="_blank"
              class="btn btn-outline-warning"
              >Gerar Boleto</a
            >
          </div>
          <div v-if="dataAbilling.billingType === 'PIX'">
            <a
              :href="dataAbilling.invoiceUrl"
              target="_blank"
              class="btn btn-outline-warning"
              >Gerar QR-Code</a
            >
          </div>
          <div v-if="dataAbilling.billingType === 'CREDIT_CARD'">
            <div v-if="dataAbilling.status === 'CONFIRMED'">
              <h4 class="text-success">Pagamento Confirmado</h4>
            </div>
            <div v-else>
              <h4 class="text-danger">Pagamento em análise</h4>
            </div>
          </div>
        </div>
      </b-modal>
    </div>
  </div>
</template>

<script>
import { usePostalCodeListStore } from "../store/postalCode";
import { useClientListStore } from "../store/client";
import { useAbillingListStore } from "../store/abilling";
import { mask } from "vue-the-mask";
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Form, Field } from "vee-validate";
import * as Yup from "yup";

export default {
  components: { Form, Field },
  directives: { mask },
  name: "register",
  setup() {
    const register = ref({});
    const dataAbilling = ref({});
    const showModal = ref(false);
    const disabledButton = ref(false);
    const postalCodeListStore = usePostalCodeListStore();
    const clientListStore = useClientListStore();
    const abillingListStore = useAbillingListStore();
    const router = useRouter();

    const schema = Yup.object().shape({
      cpfCnpj: Yup.string().required("O campo CPF/Cnpj é obrigatório"),
      firstName: Yup.string().required("O campo Nome é obrigatório"),
      postalCode: Yup.string().required("O campo CEP é obrigatório"),
      addressNumber: Yup.string().required("O campo Número é obrigatório"),
      billingType: Yup.string().required(
        "O campo Forma de pagamento é obrigatório"
      ),

      value: Yup.string().when("billingType", {
        is: (billingType) =>
          billingType === "BOLETO" ||
          billingType === "CREDIT_CARD" ||
          billingType === "PIX",
        then: (schema) =>
          schema.required("O campo Nome impresso é obrigatório"),
      }),

      dueDate: Yup.string().when("billingType", {
        is: (billingType) =>
          billingType === "BOLETO" ||
          billingType === "CREDIT_CARD" ||
          billingType === "PIX",
        then: (schema) =>
          schema.required("O campo Data de vencimento é obrigatório"),
      }),

      holderName: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) =>
          schema.required("O campo Nome impresso é obrigatório"),
      }),

      number: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) =>
          schema.required("O campo Nome impresso é obrigatório"),
      }),

      expiryDate: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) =>
          schema.required("O campo Data de expiração é obrigatório"),
      }),

      ccv: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo cvv é obrigatório"),
      }),

      cardName: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo Nome é obrigatório"),
      }),

      cardCpfCnpj: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo CPF/Cnpj é obrigatório"),
      }),

      cardEmail: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) =>
          schema
            .required("O campo E-mail é obrigatório")
            .email("Email inválido"),
      }),

      cardPhone: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo Telefone é obrigatório"),
      }),

      cardPostalCode: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo Cep é obrigatório"),
      }),

      cardAddressNumber: Yup.string().when("billingType", {
        is: "CREDIT_CARD",
        then: (schema) => schema.required("O campo Número é obrigatório"),
      }),
    });

    const saveRegister = () => {
      // disabledButton.value = true;
      dataAbilling.value = {};
      if (register.value.id != undefined) {
        saveAbilling(register.value.id);
      } else {
        clientListStore
          .saveRegister(register.value)
          .then(async (response) => {
            const idClient = await response.id;
            saveAbilling(idClient);
          })
          .catch(() => {
            console.log("Error");
          });
      }
    };

    const saveAbilling = (idClient) => {
      abillingListStore
        .saveAbilling(register.value, idClient)
        .then(async (response) => {
          dataAbilling.value = await response;
          showModal.value = true;
        })
        .catch(() => {
          console.log("Error");
        });
      disabledButton.value = false;
    };

    const searchCpfCnpj = () => {
      if (register.value.cpfCnpj.length >= 14) {
        clientListStore
          .searchCpfCnpj(register.value.cpfCnpj)
          .then(async (response) => {
            register.value.id = await response[0].id;
            register.value.name = await response[0].name;
          })
          .catch(() => {
            console.log("Error");
          });
      }
    };

    const searchPostalCode = (group) => {
      let zipCode = "";
      if (group === "person") {
        zipCode = register.value.postalCode;
      } else {
        zipCode = register.value.cardPostalCode;
      }
      if (zipCode.length == 9) {
        apiPostalCode(group, zipCode);
      }
    };

    const apiPostalCode = (group, zipCode) => {
      postalCodeListStore
        .searchPostalCode(zipCode)
        .then((response) => {
          if (group === "person") {
            register.value.address = response.address;
            register.value.province = response.province;
            register.value.state = response.state;
            register.value.city = response.cityName;
          }
          if (group === "card") {
            register.value.cardAddress = response.address;
            register.value.cardProvince = response.province;
            register.value.cardState = response.state;
            register.value.cardCity = response.cityName;
          }
        })
        .catch(() => {
          if (group === "person") {
            register.value.address = "CEP não localizado.";
          }
          if (group === "card") {
            register.value.cardAddress = "CEP não localizado.";
          }
        });
    };

    const resetForm = () => {
      router.go();
    };

    return {
      schema,
      register,
      dataAbilling,
      showModal,
      disabledButton,
      saveRegister,
      searchCpfCnpj,
      searchPostalCode,
      resetForm,
    };
  },
};
</script>
